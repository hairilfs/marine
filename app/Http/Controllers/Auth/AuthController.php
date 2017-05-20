<?php

namespace App\Http\Controllers\Auth;

use App\User;
// use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = '/';
    protected $loginPath = '/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

	public function index(){
		return \View::make('auth.index');
	}

	public function getLogin(){
		return \View::make('auth.login');
	}
	

	public function postLogin(){
		try{

		$rules = array(
            'username' => 'required|alpha_num|min:4|max:32',
            'password' => 'required|min:5',
        );

        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password'));

            $input = input::all();

        } else {

            $username = Input::get('username');
            $password =  Input::get('password') ;

		    $userdata = array(
		        'username'     	=> $username,
		        'password'  	=> $password
		    );

		    // attempt to do the login
		    if (Auth::attempt($userdata)) {
		    	//log last time user login
				// $user = User::where('Username', '=', Input::get('username'))->first();
				// if(!empty($user) ){
		  //           User::where('Id',$id)->update(
		  //           	array(	'LastLogin' => date('Y-m-d H:i:s'),
		  //           		   	'IPAddress' => Hash::make($password),
		  //           		   	// 'Token' => $realname,
		  //           		   	'UpdatedDate' => date('Y-m-d H:i:s'),
		  //           		   	'UpdatedBy' => 'System'	)
		  //           	);
				// }

		        // validation successful!
		        // redirect them to the secure section or whatever
		        // return Redirect::to('secure');
            	return Redirect::to('/');
		    } else {        

		        // validation not successful, send back to form 
		        // return Redirect::to('/');
				$message = $validator->errors();
				$message->add('Login', 'Login failed. Invalid username or password');
	            return Redirect::back()
	                ->withErrors($validator) // send back all errors to the login form
	                ->withInput();
		    }
        }
        } catch(QueryException $e){
        	Log::error('Found exception. '.$e);
        	$message = new MessageBag;
        	$message->add('Error', $e->getMessage());
        	return Redirect::to('/user')->withErrors($message);
        }       

		return Redirect::action('UserController@index');

	}


	public function getLogout(){
		Auth::logout();
    	//log last time user login

		return Redirect::to('login');
	}

	
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:250',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
