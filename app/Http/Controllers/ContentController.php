<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Content;
use App\CategoryType;
use App\ContentType;
use Validator;

class ContentController extends Controller
{
    public function appendScriptStyle(){
		//for cke
		array_push($this->scripts['header'],'../libraries/ckeditor/ckeditor.js');
	}
	
	public function getContent($slug=null){
		$content = Content::where('slug',$slug)->first();
		if ($content){
			$this->layout = 'content.item';
			$this->metas['title'] = $content->title;
			$this->view = $this->BuildLayout();
			return $this->view->withContent($content);
		} else {
			abort('404');
		}
	}
	
	public function index($type = null){
		$this->layout = 'content.index';
		$this->metas['title'] = "Агуулгын удирдлага";
		$this->view = $this->BuildLayout();
		if($type == null){
			$contentTypes = ContentType::all();
			return $this->view->withContentTypes($contentTypes);
		} else {
			$typId = CategoryType::where('slug',$type)->first()->id;
			$categories = Category::where('type',$typId)->orderBy('position')->get();
			return $this->view->withCategories($categories);
		}
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
