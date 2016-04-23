<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\CategoryType;
use App\ContentType;

class ContentController extends Controller
{
    public function appendScriptStyle(){
		//for cke
		array_push($this->scripts['header'],'../libraries/ckeditor/ckeditor.js');
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

    public function create(){
		$this->layout = 'content.create';
		$this->metas['title'] = "Агуулга нэмэх";

		$this->appendScriptStyle();

		$this->view = $this->BuildLayout();

		$this->view
			->withUser($this->user)
			->withCategories(Category::getCategoryOptions(2))
			->withContentTypeOptions(ContentType::getContentTypeOptions())
			;
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
		
		$v = Validator::make($request->all(), $rules);
		if ($v->fails()){
			return redirect()->back()->withErrors($v->errors())->withInput();
		}
		if($request->has('id')){
			
			$category->fill($request->all());
			$category->save();
		} else {
			$category = Category::create($request->all());
		}
		
		return redirect('admin/categories/edit/'.$category->id);
	}
}
