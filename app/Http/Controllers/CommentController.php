<?php namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller {

	public function addCommentModal(Request $request){
		$replyid = '';
		if($request->has('replyid')){
			$replyid = $request->get('replyid');
		}
		$type = $request->get('type');
		$item_id = $request->get('item_id');
		$addCommentModal = view('modules.modal', ['id'=>'addcommentmodal'.$replyid,'title' => trans('comment.add'),'modalbody'=>'modules.comment.add'])
			->withReplyId($replyid)
			->withType($type)
			->withItemId($item_id)
			->render()
		;
		$return['status'] = true;
		$return['view'] = $addCommentModal;
		return $return;
	}

	public function addComment(Request $request){
		$replyid = '';
		$rules = [
			'comment' => 'required|min:10',
		];
		$v = Validator::make($request->all(), $rules);
		if ($v->fails()){
			$return['status'] = false;
			$return['errors'] = $v->errors();
		} else {
			$comment = new Comment;
			$comment->user_id = $this->user->id;
			if($request->has('reply_id')){
				$replyid = $request->get('reply_id');
				$comment->reply_id = $replyid;
			}
			$comment->item_id = $request->get('item_id');
			$comment->type = $request->get('type');
			$comment->comment = $request->get('comment');
			$comment->status = 1;
			$comment->save();
			$commentView = view('modules.comment.item', ['comment'=>$comment])
				->render()
				;
			$return['status'] = true;
			$return['view'] = $commentView;
			$return['replyid'] = $replyid;
		}
		return $return;
	}

	public function deleteComment(Request $request){
		if($request->has('id')){
			$id = $request->get('id');
			$comment = Comment::find($id);
			$reply = $comment->reply;
			foreach($reply as $r){
				$r->delete();
			}
			$comment->delete();
			if($comment->user_id == $this->user->id){
				
				$return['status'] = true;
			} else {
				$return['status'] = false;
				$return['errors'] = [trans('comment.notyourcomment')];
			}
		}
		return $return;
	}
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