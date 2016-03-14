<?php namespace App\Http\Controllers;
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
	$this->view = $this->BuildLayout();

	$this->view
		->withUser($this->user)
		->withCategories(Category::getCategoryOptions(1))
		;
	return $this->view;
	}
  
	public function postNext(Request $request){
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
					return $v->errors();
				}
				$project = new Project;
				$project->title = $request->get('title');
				$project->slug = $request->get('slug');
				$project->category_ids = $request->get('category_ids');
				$project->save();
				
				$addprojectdetail = View::make('project.steps.projectdetail')
					->withSocialnav($socialnav)
					->withCart($cart)
					->withConfirmation($payment->ConfirmationNumber)
					->withLocation($location)
					->withCustomertype($this->getCustomerType())
					->withCustomer($this->getCustomer())
					->render();
				
			break;
		}
		
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