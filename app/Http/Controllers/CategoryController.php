<?php namespace App\Http\Controllers;
use App\Category;
use App\CategoryType;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index($type = null)
  {
	$this->layout = 'categories.index';
	$this->metas['title'] = "Ангилалууд";
	$this->view = $this->BuildLayout();
	if($type == null){
		$categoryTypes = CategoryType::all();
		return $this->view->withCategoryTypes($categoryTypes);
	} else {
		$typId = CategoryType::where('slug',$type)->first()->id;
		$categories = Category::where('type',$typId)->orderBy('position')->get();
		return $this->view->withCategories($categories);
	}
  }
  
  private function getCategoryTypeOptions(){
	$return = [];
	$categoryTypes = CategoryType::select('id','title')->get();
	foreach($categoryTypes as $ct){
		$return[$ct->id] = $ct->title;
	}
	return $return;
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create($id=null)
  {
	  
    $this->layout = 'categories.create';
	$this->metas['title'] = "Ангилал нэмэх";
	$this->view = $this->BuildLayout();
	$this->view->with('category_type_options',$this->getCategoryTypeOptions());
	if($id!=null){
		$category = Category::find($id);
		$this->view->withCategory($category);
	}
	return $this->view;
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
	$rules = [
		'title' => 'required|unique:categories',
		'slug' => 'required|unique:categories',
		'type' => 'required'
	];
	if($request->has('id')){
		$category = Category::find($request->input('id'));
		$rules = [
			'title' => 'required|unique:categories,title,'.$category->id,
			'slug' => 'required|unique:categories,slug,'.$category->id,
			'type' => 'required'
		];
	}
	
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
	
	return redirect('admin/categories/create/'.$category->id);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request)
  {
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }
  
}

?>