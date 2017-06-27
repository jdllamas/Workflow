<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/workflow';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	public function username()
	{
		return 'username';
	}
	
	public function authenticate()
    {
		$users = DB::table('users')->where([
										['username', '=', $username],
										['password', '=', $password],
										])->first();
		Log::info('Showing user profile for user: '.$users);
		
        /*if (Auth::attempt(['username' => $username, 'password' => $password])) {
            // Authentication passed...
            return redirect()->intended('home');
        }
		*/
    }
	
	public function login(Request $request){
		// Do your custom login magic here.
		$username = strtoupper($request->username);
		$password = strtoupper($request->password);
		$user = DB::table('users')->where('username','=', $username)->first();
		//$u = User::find($username);
		if(!is_null($user)){
			if (strcmp($username, $user->username) == 0 && strcmp($password, $user->password) == 0) {
				$login = Auth::loginUsingId($username);
				session(['username' => $username]);
				return redirect()->intended('/workflow');
				//return view('workflow.index');
				
			}
		}
		$errors = [$this->username() => trans('auth.failed')];
		$request->session()->forget('username');
		$request->session()->flush();
		//return redirect()->guest('login');
		return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }
	
	public function logout(Request $request)
    {
		$request->session()->flush();
        $request->session()->regenerate();
        return redirect()->intended('/login');
    }
	
}
