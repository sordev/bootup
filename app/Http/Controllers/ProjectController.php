<?php namespace App\Http\Controllers;
use Validator;
use View;
use App\Category;
use App\Project;
use Illuminate\Http\Request;
class ProjectController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }
  
	public function add()
	{
	$this->layout = 'project.add';
	$this->metas['title'] = "Төсөл нэмэх";
	//for upload
	array_push($this->scripts['footer'],'upload/jquery.ui.widget.js');
	array_push($this->scripts['footer'],'upload/load-image.all.min.js');
	array_push($this->scripts['footer'],'upload/canvas-to-blob.min.js');
	array_push($this->scripts['footer'],'upload/jquery.iframe-transport.js');
	array_push($this->scripts['footer'],'upload/jquery.fileupload.js');
	array_push($this->scripts['footer'],'upload/jquery.fileupload-process.js');
	array_push($this->scripts['footer'],'upload/jquery.fileupload-image.js');
	array_push($this->styles,'jquery.fileupload.css');
	//for cke
	array_push($this->scripts['header'],'../libraries/ckeditor/ckeditor.js');
	
	$this->view = $this->BuildLayout();

	$this->view
		->withUser($this->user)
		->withCategories(Category::getCategoryOptions(1))
		;
	return $this->view;
	}
  
	public function postNext(Request $request){
		$return =[];
		$return['status'] = false;
		$step = $request->get('step');
		switch($step){
			case 'addproject':
				$rules = [
					'title' => 'required|unique:projects',
					'slug' => 'required|unique:projects',
					'category_ids' => 'required',
				];
				$v = Validator::make($request->all(), $rules);
				if ($v->fails()){
					$return['status'] = true;
					$return['errors'] = $v->errors();
				} else {
					$project = new Project;
					$project->title = $request->get('title');
					$project->user_id = $this->user->id;
					$project->slug = $request->get('slug');
					//TODO project ids comma separated
					$project->category_ids = $request->get('category_ids');
					$project->save();
					
					$projectCategoryIds = explode(',',$project->category_ids);
					$projectCategories = [];
					foreach($projectCategoryIds as $pg){
						$projectCategories[] = Category::find($pg)->title;
					}
					
					$project->category = implode(', ',$projectCategories);
					$addprojectdetail = View::make('project.steps.addprojectdetail')
						->withProject($project)
						->render()
					;
					$return['status'] = true;
					$return['view'] = $addprojectdetail;
				}
			break;
		}
		
		return $return;
	}

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    
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
  public function update($id)
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