<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		parent::__construct();
        $this->middleware('guest');
    }

	public function getEmail()
    {
		$this->layout = 'auth.password';
		$this->metas['title'] = "Нууц үгээ солих";
		$this->view = $this->BuildLayout();
        return $this->view;
    }

	public function getReset($token = null)
    {
        if (is_null($token)) {
            throw new NotFoundHttpException;
        }
		$this->layout = 'auth.reset';
		$this->metas['title'] = "Нууц үгээ солих";
		$this->view = $this->BuildLayout()->with('token', $token);

        return $this->view;
    }
}
