<?php namespace App\Http\Controllers;
use Validator;
use View;
use Session;
use App\Category;
use App\Project;
use App\Content;
use App\User;
use App\Goal;
use App\Reward;
use Illuminate\Http\Request;
class ProjectController extends Controller {

	public function projects(Request $request,$category=null){
		$this->layout = 'project.list';
		$this->metas['title'] = "Төслүүд";
		// General list
		$projects = Project::orderBy('id','DESC')->where('status',1);
		$featured = $projects->where('featured',1);
		if($category!=null){
			$categoryObject = Category::where('slug',$category)->first();
			if($categoryObject){
				$projects->where('category_ids',$categoryObject->id);
				$featured->where('category_ids',$categoryObject->id);
			}
		}
		$featured = $featured->get()->take(3);
		$projects = $projects->paginate(6);
		$this->view = $this->BuildLayout();
		$this->view
			->withProjects($projects)
			->withFeatured($featured)
			;
		return $this->view;
	}

	public function projectsSearch(Request $request){
		$this->layout = 'project.list';
		$this->metas['title'] = 'Төслүүд | "'.$request->get('searchtext').'" Хайлтын үр дүн ';
		// General list
		$projects = Project::orderBy('id','DESC')
			->where('status',1)
			->where('title','LIKE','%'.$request->get('searchtext').'%')
			->paginate(6)
			->appends($request->except('page'))
		;
		$this->view = $this->BuildLayout();
		$this->view
			->withProjects($projects)
			->withCategory(false)
			;
		return $this->view;
	}

	public function userProjects(Request $request,$category=null){
		$this->layout = 'project.table';
		$this->metas['title'] = "Миний Төслүүд";
		// General list
		$projects = Project::orderBy('id','DESC')
			->where('user_id',$this->user->id)
			->paginate(10)
		;
		$this->view = $this->BuildLayout();
		$this->view
			->withProjects($projects)
			;
		return $this->view;
	}

	public function adminProjects(Request $request,$category=null){
		$this->layout = 'project.table';
		$this->metas['title'] = "Бүх Төслүүд";
		// General list
		$projects = Project::orderBy('id','DESC')
			->paginate(10)
		;
		$this->view = $this->BuildLayout();
		$this->view
			->withUser($this->user)
			->withProjects($projects)
			;
		return $this->view;
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
		//for datetimepicker
		array_push($this->scripts['footer'],'../libraries/bower_components/moment/min/moment.min.js');
		array_push($this->scripts['footer'],'../libraries/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js');
		array_push($this->styles,'../libraries/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css');
	}

	public function add(){
		$this->layout = 'project.add';
		$this->metas['title'] = "Төсөл нэмэх";

		$this->appendScriptStyle();

		$this->view = $this->BuildLayout();

		$contentData = [
			['id'=>'faq','title'=>'FAQ Асуулт хариулт','content'=>Content::getContent('faq')],
			['id'=>'requirment','title'=>'Төслийн шалгуур','content'=>Content::getContent('requirment')],
			['id'=>'funding','title'=>'Хөрөнгө оруулах','content'=>Content::getContent('funding')],
			['id'=>'tooos','title'=>'Үйлчилгээний нөхцөл','content'=>Content::getContent('tos')],
		];

		$this->view
			->withUser($this->user)
			->withCategories(Category::getCategoryOptions(1))
			->withContentData($contentData)
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
					'slug' => 'required|unique:projects|alphanum',
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
					$return['url'] = $project->editurl;
				}
			break;
			// ajax CKE editor wasn't working so abandoning this
			/**/
			case 'addprojectdetail':
				$rules = [
					//'image' => 'required',
					//'video' => 'required',
					//'intro' => 'required',
					//'category_ids' => 'detail',
				];
				$v = Validator::make($request->all(), $rules);
				if ($v->fails()){
					$return['status'] = false;
					$return['errors'] = $v->errors();
				} else {
					if($request->has('video')){
						$video = $request->get('video');
						$parsed = $this->parseVideoUrl($video);
						if($parsed['status'] == false){
							return $parsed;
						}
					}
					$return['status'] = true;
				}
			break;
		}
		
		return $return;
	}

	public function project($slug){
		$project = Project::where('slug',$slug);
		$status = $video = null;
		$edit = false;
		if(!$this->user){
			$project->where('status',1);
		}
		if($project->exists()){
			$project = $project->first();
			$this->metas['title'] = $project->title;
			$this->layout = 'project.view';
			if($this->user && ($this->user->id == $project->user_id || $this->user->role == 1)){
				$edit = true;
			}
			
			$video = $this->parseVideoUrl($project->video);
		} else {
			$this->metas['title'] = 'Төсөл олдсонгүй';
			$this->layout = 'errors.404';
			$status = "Таны хайсан төсөл олдсонгүй эсвэл идэвхигүй байна. Та хэрвээ төслийн эзэмшигч бол нэвтэрч ороод үзнэ үү.";
			$project = null;
		}
		$this->view = $this->BuildLayout();
		return $this->view
			->withStatus($status)
			->withEdit($edit)
			->withVideo($video)
			->withProject($project)
		;
	}

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

	public function update(Request $request){
		$rules = [
			//'image' => 'required',
			//'video' => 'required',
			//'intro' => 'required',
			//'category_ids' => 'detail',
		];
		$v = Validator::make($request->all(), $rules);
		if ($v->fails()){
			$return['status'] = false;
			$return['errors'] = $v->errors();
		} else {
			$project = Project::find($request->get('id'));
			//Check if project is user's own
			if($this->user->id == $project->user_id){
				$project->image = $request->get('image');
				$project->intro = $request->get('intro');
				$project->video = $request->get('video');
				$project->detail = $request->get('detail');
				$project->team_members = $request->get('team_members');
				$project->save();
			}
			Session::flash('status', trans('project.updated'));
			return redirect('project/edit/'.$project->id);
		}
		if($return['status'] == false){
			return $return;
		}
		return redirect()->back()->withErrors(['error'=>trans('project.cantupdate')]);
	}

	public function delete($id=null){
		$project = Project::find($id);
		if($project->status > 0){
			return redirect()->back()->withErrors(['error'=>trans('project.cantdelete')]);
		}
		if($project->user_id == $this->user->id || $this->user->role == 1){
			$project->delete();
		} else {
			return redirect()->back()->withErrors(['error'=>trans('project.cantdelete')]);
		}
		return redirect()->back()->withErrors(['error'=>trans('project.deleted')]);
	}

	public function enable($id=null){
		$project = Project::find($id);
		if($this->user->role == 1){
			$project->status = 1;
			$project->save();
			return redirect()->back()->withErrors(['error'=>trans('project.updated')]);
		} 
		return redirect()->back()->withErrors(['error'=>trans('project.cantupdate')]);
	}

	public function disable($id=null){
		$project = Project::find($id);
		if($this->user->role == 1){
			$project->status = 0;
			$project->save();
			return redirect()->back()->withErrors(['error'=>trans('project.updated')]);
		} 
		return redirect()->back()->withErrors(['error'=>trans('project.cantupdate')]);
	}

	public function lock($id=null){
		$project = Project::find($id);
		if($this->user->role == 1){
			$project->status = 2;
			$project->save();
			return redirect()->back()->withErrors(['error'=>trans('project.updated')]);
		} 
		return redirect()->back()->withErrors(['error'=>trans('project.cantupdate')]);
	}

	public function addGoalModal(){
		$addGoalModal = view('modules.modal', ['id'=>'addgoalmodal','title' => 'Төслийн зорилт нэмэх','modalbody'=>'modules.project.goal_add'])
			->render()
		;
		$return['status'] = true;
		$return['view'] = $addGoalModal;
		return $return;
	}

	public function addGoal(Request $request){
		$rules = [
			'title' => 'required',
			'description' => 'required',
			'start' => 'required',
			'end' => 'required',
			'phase' => 'required',
			'goal' => 'required',
		];
		$v = Validator::make($request->all(), $rules);
		if ($v->fails()){
			$return['status'] = false;
			$return['errors'] = $v->errors();
		} else {
			if($request->has('project_id')){
				$project_id = $request->get('project_id');
				$project = Project::find($project_id);
				if($project && $project->user_id == $this->user->id && $project->status == 0){
					$goal = new Goal;
					$goal->title = $request->get('title');
					$goal->project_id = $request->get('project_id');
					$goal->description = $request->get('description');
					$goal->start = $request->get('start');
					$goal->end = $request->get('end');
					$goal->phase = $request->get('phase');
					$goal->goal = $request->get('goal');
					$goal->save();
					$goalDetail = View::make('modules.project.goal_list_item')
						->with('g',$goal)
						->with('remove',true)
						->render()
					;
					$return['status'] = true;
					$return['view'] = $goalDetail;
				} else {
					$return['status'] = false;
					$return['uid'] = $this->user->id;
					$return['project_id'] = $project_id;
					$return['errors'] = ['Таны төсөл биш байна'];
				}
			} else {
				$return['status'] = false;
				$return['errors'] = ['Төслийн АйДи байхгүй байна'];
			}
			
		}
		return $return;
	}

	public function removeGoal(Request $request){
		$return['status'] = false;
		$return['errors'] = [];
		if($request->has('project_id')){
			$project_id = $request->get('project_id');
			$project = Project::find($project_id);
			if($project && $project->user_id == $this->user->id && $project->status == 0){
				$goalid = $request->get('goalid');
				$goal = Goal::find($goalid);
				if ($goal->project_id == $project_id){
					$goal->delete();
					$return['status'] = true;
					$return['message'] = ['Зорилт устгагдлаа'];
				}
			} else {
				$return['status'] = false;
				$return['errors'] = ['Таны төсөл биш байна'];
			}
		} else {
			$return['status'] = false;
			$return['errors'] = ['Төслийн АйДи байхгүй байна'];
		}
		return $return;
	}

	public function addRewardModal(){
		$addRewardModal = view('modules.modal', ['id'=>'addrewardmodal','title' => 'Төслийн урамшуулал нэмэх','modalbody'=>'modules.project.reward_add'])
			->render()
		;
		$return['status'] = true;
		$return['view'] = $addRewardModal;
		return $return;
	}

	public function addReward(Request $request){
		$rules = [
			'title' => 'required',
			'description' => 'required',
			'value' => 'required',
			'amount' => 'required',
			'estimated_date' => 'required',
		];
		$v = Validator::make($request->all(), $rules);
		if ($v->fails()){
			$return['status'] = false;
			$return['errors'] = $v->errors();
		} else {
			if($request->has('project_id')){
				$project_id = $request->get('project_id');
				$project = Project::find($project_id);
				if($project && $project->user_id == $this->user->id && $project->status == 0){
					$reward = new Reward;
					$reward->title = $request->get('title');
					$reward->image = $request->get('reward_image');
					$reward->project_id = $request->get('project_id');
					$reward->description = $request->get('description');
					$reward->value = $request->get('value');
					$reward->amount = $request->get('amount');
					$reward->estimated_date = $request->get('estimated_date');
					$reward->save();
					$rewardListItem = View::make('modules.project.reward_list_item')
						->with('r',$reward)
						->with('remove',true)
						->render()
					;
					$return['status'] = true;
					$return['view'] = $rewardListItem;
				} else {
					$return['status'] = false;
					$return['uid'] = $this->user->id;
					$return['project_id'] = $project_id;
					$return['errors'] = ['Таны төсөл биш байна'];
				}
			} else {
				$return['status'] = false;
				$return['errors'] = ['Төслийн АйДи байхгүй байна'];
			}
			
		}
		return $return;
	}

	public function removeReward(Request $request){
		$return['status'] = false;
		$return['errors'] = [];
		if($request->has('project_id')){
			$project_id = $request->get('project_id');
			$project = Project::find($project_id);
			if($project && $project->user_id == $this->user->id && $project->status == 0){
				$rewardid = $request->get('rewardid');
				$reward = Reward::find($rewardid);
				if ($reward->project_id == $project_id){
					$reward->delete();
					$return['status'] = true;
					$return['message'] = ['Зорилт устгагдлаа'];
				}
			} else {
				$return['status'] = false;
				$return['errors'] = ['Таны төсөл биш байна'];
			}
		} else {
			$return['status'] = false;
			$return['errors'] = ['Төслийн АйДи байхгүй байна'];
		}
		return $return;
	}

	public function claimRewardModal(Request $request){
		$col = 6;
		if($this->user){
			$col = 12;
		}
		$rewardid = $request->get('rewardid');
		$reward = Reward::find($rewardid);
		$claimRewardModal = view('modules.modal', ['id'=>'claimrewardmodal'.$rewardid,'title' => 'Урамшуулал авах','modalbody'=>'modules.project.reward_claim'])
			->withUser($this->user)
			->withCol($col)
			->withReward($reward)
			->render()
		;
		$return['status'] = true;
		$return['view'] = $claimRewardModal;
		return $return;
	}

	public function donateModal(Request $request){
		$col = 6;
		if($this->user){
			$col = 12;
		}
		$projectid = $request->get('projectid');
		$project = Reward::find($projectid);
		$donateModal = view('modules.modal', ['id'=>'donatemodal'.$projectid,'title' => trans('project.donate'),'modalbody'=>'modules.project.donate'])
			->withUser($this->user)
			->withCol($col)
			->withProject($project)
			->render()
		;
		$return['status'] = true;
		$return['view'] = $donateModal;
		return $return;
	}

	public function claimReward(){
		$addRewardModal = view('modules.modal', ['id'=>'addrewardmodal','title' => 'Төслийн урамшуулал нэмэх','modalbody'=>'modules.project.reward_add'])
			->render()
		;
		$return['status'] = true;
		$return['view'] = $addRewardModal;
		return $return;
	}

	public function supporterListModal(Request $request){
		$projectid = $request->get('projectid');
		$project = Project::find($projectid);
		if($this->user->id == $project->user_id || $this->user->role == 1){
			$supporterListModal = view('modules.modal', ['id'=>'supporterlistmodal'.$project->id,'title' => 'Таны '.$project->title.' төслийн дэмжигчид ','modalbody'=>'modules.project.supporter_list','size'=>'lg'])
				->withProject($project)
				->render()
				;
		}
		$return['status'] = true;
		$return['view'] = $supporterListModal;
		return $return;
	}
}

?>