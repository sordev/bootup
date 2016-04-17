<?php namespace App\Http\Controllers;
use Validator;
use View;
use App\Category;
use App\Project;
use App\User;
use Illuminate\Http\Request;
class ProjectController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */

	public function getProjects(Request $request){
		$projects = Project::orderBy('id','DESC');
		if($request->is('user/projects') && $this->user){
			$projects->where('user_id',$this->user->id);
		}
		$projects = $projects->paginate(8);
		return $projects;
	}

	public function projects(Request $request,$userid=null){
		$this->layout = 'project.list';
		$this->metas['title'] = "Төслүүд";
		$edit = false;
		//Request::is('user/projects*')

		// General list
		$projects = Project::orderBy('id','DESC');

		// Public List
		if($request->is('projects')){
			$projects->where('status',1);
		}

		// User's own list
		if($request->is('user/projects') && $this->user){
			$this->metas['title'] = "Миний Төслүүд";
			$projects->where('user_id',$this->user->id);
			$edit = true;
			
		}

		// User's list for public
		if($request->is('user/profile/*/projects')){
			$user = User::getUserbyid($userid);
			$this->metas['title'] = $user->firstname." ".$user->lastname." -н Төслүүд";
			$projects->where('status',1);
		}

		$projects = $projects->paginate(8);
		
		$this->view = $this->BuildLayout();
		$this->view
			->withEdit($edit)
			->withProjects($projects)
			;
		return $this->view;
	}

	public function index(){
	}

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

	public function appendScriptStyle(){
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
	}
	public function add(){
		$this->layout = 'project.add';
		$this->metas['title'] = "Төсөл нэмэх";

		$this->appendScriptStyle();

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
					$return['status'] = false;
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
	public function project($slug){
		$project = Project::where('slug',$slug);
		$status = null;
		$edit = false;
		if($project->exists()){
			$project = $project->first();
			$this->metas['title'] = $project->title;
			$this->layout = 'project.view';
		} else {
			$this->metas['title'] = 'Төсөл олдсонгүй';
			$this->layout = 'errors.404';
			$status = "Таны хайсан төсөл олдсонгүй";
			$project = null;
		}
		if($this->user && $project){
			if($this->user->id == $project->user_id){
				$edit = true;
			}
		}
		$this->view = $this->BuildLayout();
		return $this->view
			->withStatus($status)
			->withEdit($edit)
			->withProject($project)
		;
	}

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
	public function edit($id){
		$this->appendScriptStyle();
		$project = Project::where('id',$id);
		$status = null;
		$edit = false;
		if($project->exists()){
			$project = $project->first();
			if($this->user->id == $project->user_id){
				$this->metas['title'] = $project->title;
				$this->layout = 'project.edit';
			} else {
				$this->metas['title'] = 'Хандах эрхгүй';
				$this->layout = 'errors.403';
				$status = "Танд уг төслийг засах эрх байхгүй байна";
			}
		} else {
			$this->metas['title'] = 'Төсөл олдсонгүй';
			$this->layout = 'errors.404';
			$status = "Таны хайсан төсөл олдсонгүй";
			$project = null;
		}
		$this->view = $this->BuildLayout();
		return $this->view
			->withCategories(Category::getCategoryOptions(1))
			->withStatus($status)
			->withEdit($edit)
			->withProject($project)
		;
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