<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Project;
use App\Content;
use App\CategoryType;
use App\ContentType;
use App\User;
use Validator;

class ContentController extends Controller
{
    public function appendScriptStyle(){
		//for cke
		array_push($this->scripts['header'],'../libraries/ckeditor/ckeditor.js');
	}
	
	public function updates(Request $request,$project_id){
		$project = Project::find($project_id);
		if($project && $project->user_id == $this->user->id){
			$this->layout = 'content.table';
			$this->metas['title'] = trans('project.updates');
			$this->view = $this->BuildLayout();
			return $this->view
				->withContents($this->getContents($request,3,$project->slug));
		} else {
			abort('404');
		}
	}
	
	public function item($slug=null){
		$content = Content::where('slug',$slug)->where('status','publish')->first();
		if ($content){
			$this->layout = 'content.item';
			$this->metas['title'] = $content->title;
			$this->view = $this->BuildLayout();
			return $this->view->withContent($content);
		} else {
			abort('404');
		}
	}

	public function blog(Request $request,$category_slug=null){
		$this->layout = 'content.blog';
		$this->metas['title'] = trans('blog.blog');
		$this->view = $this->BuildLayout();
		$categories = Category::where('type',3)->get();
		return $this->view
			->withBlogs($this->getContents($request,2,$category_slug))
			->withCategories($categories);
	}

	public function blogItem($category_slug,$slug){
		$category = Category::where('slug',$category_slug)->first();
		$content = Content::where('slug',$slug)->where('category_id',$category->id)->first();
		if ($content){
			$this->layout = 'content.item';
			$this->metas['title'] = $content->title;
			$this->view = $this->BuildLayout();
			return $this->view->withContent($content);
		} else {
			abort('404');
		}
	}

	public function projectItem($project_slug,$slug){
		$project = Project::where('slug',$project_slug)->first();
		$content = Content::where('slug',$slug)->where('category_id',$project->id)->first();
		if ($content){
			$this->layout = 'content.item';
			$this->metas['title'] = $content->title;
			$this->view = $this->BuildLayout();
			return $this->view->withContent($content);
		} else {
			abort('404');
		}
	}

	public function getContents($request,$type=null,$category_slug=null){
		$contents = Content::orderBy('created_at','desc')->where('status','publish');
		
		if($request->has('title')){
			$contents->where('title','like','%'.$request->get('title').'%');
		}
		if($request->has('category_id')){
			$contents->where('category_id',$request->get('category_id'));
		}
		if($request->has('type')){
			$contents->where('type',$request->get('type'));
		}
		if($type!=null){
			$contents->where('type',$type);
		}
		if($category_slug!=null){
			switch($type){
				case 1:
				case 2:
					$category = Category::where('slug',$category_slug)->first();
				break;
				case 3:
					$category = Project::where('slug',$category_slug)->first();
				break;
			}
			$contents->where('category_id',$category->id);
		}
		if($request->has('status')){
			$status = $request->get('status');
			if($status == 'trashed'){
				$contents->onlyTrashed();
			} else {
				$contents->where('status',$request->get('status'));
			}
		}
		$contents = $contents->paginate(15)->appends($request->except('page'));
		
		return $contents;
	}

	public function index(Request $request){
		$this->layout = 'content.index';
		$this->metas['title'] = "Агуулгын удирдлага";
		$this->view = $this->BuildLayout();
		$contentTypes = ContentType::all();
		$categories = Category::getCategoryOptions('2');
		return $this->view
			->withCategories(Category::getCategoryOptions(2))
			->withContentTypeOptions(ContentType::getContentTypeOptions())
			->withContents($this->getContents($request))
		;
	}

    public function create($id=null){
		$this->layout = 'content.create';
		$this->metas['title'] = "Агуулга нэмэх";
		if($id!=null){
			$this->metas['title'] = "Агуулга засах";
		}
		$this->appendScriptStyle();
		$this->view = $this->BuildLayout();
		$this->view
			->withUser($this->user)
			->withCategories(Category::getCategoryOptions(2))
			->withContentTypeOptions(ContentType::getContentTypeOptions())
			;
		if($id!=null){
			$content = Content::find($id);
			$this->view->withContent($content);
		}
		return $this->view;
	}

	public function delete($id=null){
		$content = Content::find($id)->delete();
		return redirect()->back()->withErrors(['error'=>['Агуулга хогийн саванд орлоо']]);
	}

	public function destroy($id=null){
		$content = Content::where('id',$id)->forceDelete();
		return redirect()->back()->withErrors(['error'=>['Агуулга устгагдлаа']]);
	}

	public function restore($id=null){
		$content = Content::where('id',$id)->restore();
		return redirect()->back()->withErrors(['error'=>['Агуулга сэргээгдлээ']]);
	}

	public function store(Request $request){
		$rules = [
			'title' => 'required',
			'slug' => 'required|unique:contents',
			'type' => 'required',
			'category_id' => 'required',
			'content' => 'required'
		];
		if($request->has('id')){
			$content = Content::find($request->get('id'));
			$rules = [
				'slug' => 'required|unique:contents,title,'.$content->id,
			];
		}
		$v = Validator::make($request->all(), $rules);
		if ($v->fails()){
			return redirect()->back()->withErrors($v->errors())->withInput();
		}
		if($request->has('id')){
			//$content = Content::find($request->get('id'));
			if($this->user->id == $content->user_id){
				$content->fill($request->all());
				$content->save();
			} else {
				return redirect()->back()->withErrors(['error'=>['Таны агуулга биш байна']]);
			}
		} else {
			$content = Content::create($request->all());
			$content->user_id = $this->user->id;
			$content->save();
		}
		
		return redirect('admin/content/edit/'.$content->id);
	}
}
