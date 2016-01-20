<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use validator, hash, auth
use Validator;
use Hash;
use Auth;
use File;

//use base controller
use App\Http\Controllers\Controller;

//user model
use App\User;

//settings model
use App\Setting;
use App\Profile;

use Response;
use Socialite;

class UserController extends Controller {

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
		$this->layout = 'user.register';
		$this->metas['title'] = "Бүүтап бүртгэлийн хэсэг";
		
		array_push($this->scripts['footer'],'https://www.google.com/recaptcha/api.js');
		
		$recaptchakey = Setting::getSetting('recaptchakey');
		$this->view = $this->BuildLayout()->with('recaptchakey',$recaptchakey);
        
		return $this->view;
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
		$v = Validator::make($request->all(), [
			'email' => 'required|unique:users|email',
			'password' => 'required',
			'tos' => 'required',
		]);
		
		//recaptcha implementation 
		$recaptcha = new \ReCaptcha\ReCaptcha(Setting::getSetting('recaptchasecret'));
		$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
		
		if ($v->fails() || $resp->isSuccess()==false){
			if ($resp->isSuccess()==false){
				$v->errors()->add('g-recaptcha', 'Би робот биш гэсэн чагтыг тэмдэглэнэ үү');
			}
			return redirect()->back()->withErrors($v->errors());
		}
		
		$user = new User;
		$user->email = $request->input('email');
		$user->password = Hash::make($request->input('password'));
		$user->registration_url = 'local';
		$user->register_ip = $_SERVER['REMOTE_ADDR'];
		$user->public = 0;
		$user->status = 1;
		$user->save();
		
		if (Auth::login($user)) {
			return redirect('/user/profile');
		} else {
			// validation not successful, send back to form 
			return redirect('/user/login');
		}
		return redirect('/user/profile/'.$user->usr_id);
  }
  
  public function login(Request $request,$provider=null){
		$this->layout = 'user.login';
		$this->metas['title'] = "User Profile";
		$this->view = $this->BuildLayout();
		$user = $socialUser = '';

		//https://laracasts.com/series/whats-new-in-laravel-5/episodes/9
		switch ($provider) {
			case 'facebook':
			case 'twitter':
			case 'google':
				if ($request->has('code') || $request->has('oauth_token') || $request->has('state')){
					$socialUser = Socialite::with($provider)->user();
				} else {
					$socialite = Socialite::with($provider);
					if ($provider == 'facebook'){
						$socialite->scopes(['user_friends','public_profile','email']);
					}
					return $socialite->redirect();
					
				}
				break;
			
			default:
				# code...
				break;
		}

		if ($socialUser){
			$email = $socialUser->email;
			$name = $socialUser->name;
			$nameArray = explode(' ',$name);
			$fname = reset($nameArray);
			$lname = str_replace($fname,'',trim($name));
			$fb_id = $tw_id = $gp_id = $photo_url = '';
			$avatarSavePath = public_path('images/users/avatars');
			switch ($provider) {
				case 'facebook':
					$fb_id = $socialUser->id;
					$gender = $socialUser->user['gender'];
					$photo_url = $socialUser->avatar_original;
					
					$user = User::where('fb_id',$fb_id);
				break;
				case 'twitter':
					$tw_id = $socialUser->id;
					$photo_url = $socialUser->avatar_original;
					
					$user = User::where('tw_id',$tw_id);
				break;
				case 'google':
					$gp_id = $socialUser->id;
					$gender = $socialUser->user['gender'];
					$photo_url = $socialUser->avatar;
					
					$user = User::where('gp_id',$gp_id);
				break;
				default:
				break;
			}
			if (!empty($photo_url)){
				$photo_urlArray = parse_url($photo_url);
				unset($photo_urlArray['query']);
				$photo_url = $photo_urlArray['scheme'].'://'.$photo_urlArray['host'].$photo_urlArray['path'];
			}
			
			if ($user->exists()){
				$user = $user->first();
			} else {
				//if not existing then just register
				$user = User::create([
					'email'=>$email,
					'usr_fname'=>$fname,
					'usr_lname'=>$lname,
					'registration_url'=>$provider,
					'usr_ip'=>$request->getClientIp(),
					'fb_id'=>$fb_id,
					'tw_id'=>$tw_id,
					'gp_id'=>$gp_id,
				]);
				$profile = new Profile;
				if (!empty($photo_url)){
					$ext = pathinfo($photo_url,PATHINFO_EXTENSION);
					$destinationPath = public_path('images/users/avatars');
					file_put_contents($destinationPath.'/'.$user->usr_id.'.'.$ext, fopen($photo_url, 'r'));
					$profile->photo_url=$user->usr_id.'.'.$ext;
				}
				$profile->gender = $gender;
				$user->profile()->save($profile);
			}
			Auth::login($user,true);
		}
		
		//if already logged in
		if (Auth::check() || Auth::viaRemember()){
			return redirect('/user/profile');
		}
		
		//if doing login
		if ($request->isMethod('post')){
			//validate input
			$v = Validator::make($request->all(), [
				'email' => 'required|email',
				'password' => 'required'
			]);
			
			//recaptcha implementation 
			//TODO after 5 attempt show recaptcha
			//$recaptcha = new \ReCaptcha\ReCaptcha(Setting::getSetting('recaptchasecret'));
			//$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
			
			if ($v->fails()){
				return redirect()->back()->withErrors($v->errors());
			}
			
			$userdata = array(
				'email' => $request->get('email'),
				'password' => $request->get('password'),
			);
			
			$remember = false;
			if ($request->has('remember_me') && $request->get('remember_me')==1){
				$remember = true;
			}
			
			if (Auth::attempt($userdata,$remember)) {
				return redirect('/user/profile');
			} else {
				// validation not successful, send back to form 
				return redirect()->back()->withErrors('Please check your email and/or password or register')->withInput();
			}
		} 
		return $this->view;
	}
	
	//logout
	public function logout(Request $request){
		Auth::logout(); // log the user out of our application
		return redirect('/user/login'); // redirect the user to the login screen
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
  
	public function editPassword(Request $request)
    {
        $this->layout = 'user.editpassword';
		$this->metas['title'] = "Change Password";
		$this->view = $this->BuildLayout();
		$return = '';
		if (Auth::check() || Auth::viaRemember()){
			$user = Auth::user();
			return $this->view
				->withUser($user)
			;
		}
		return redirect('/user/login');
    }
	
	public function updatePassword(Request $request)
    {
		$v = Validator::make($request->all(), [
			'password_new' => 'required|min:5|max:16|confirmed',
			'password_new_confirmation' => ''
		]);
		if ($v->fails()){
			$errors = $v->errors();
			return redirect()->back()->withErrors($errors)->withInput();
		}
		$user = Auth::user();
		if (!empty($user->password)){
			$v = Validator::make($request->all(), [
				'password_old' => 'required|min:5|max:16'
			]);
			if ($v->fails()){
				$errors = $v->errors();
				return redirect()->back()->withErrors($errors)->withInput();
			}
			
			if(Hash::check($request->get('password_old'), $user->password)){
				$user->password = Hash::make($request->get('password_new'));
				$user->save();
			} else {
				return redirect()->back()->withErrors('Your current password is wrong');
				//Auth::logout();
			}
		} else {
			$user->password = Hash::make($request->get('password_new'));
			$user->save();
		}
		
		return redirect()->back()->withStatus('Password Changed');
    }
  
}

?>