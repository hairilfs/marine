<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Role;
use App\Model\Employee_Profile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

use \View;

class UserController extends BaseController {

	public function __construct()
	{
		$this->middleware('auth');
	}
	
	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/
	public function index()
	{
		$data = DB::select('select * from vw_user ');
		return View::make('user.index')->with('data',$data);
	}
	/**
	* Show the form for creating a new resource.
	*
	* @return Response
	*/
	public function add()
	{   
        $data_employee = DB::select('select id, nip, name, sex,harbour_master_name, email01 from vw_employee_profile ');     
        $list_role = Role::orderBy('name')->lists('name', 'Id')->all();
        $list_employee = Employee_Profile::orderBy('name')->lists('name', 'Id')->all();
		return View::make('user.add')->with('list_role', $list_role)->with('list_employee', $list_employee)->with('data_employee', $data_employee);
	}
	/**
	* Store a newly created resource in storage.
	*
	* @return Response
	*/
	public function save()
	{
		try{

		$rules = array(
            'username' => 'required|alpha_num|min:4|max:32',
            'password' => 'required|min:5|confirmed',
            'email' => 'required',
            'password_confirmation' => 'required',
            'id_role' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();

            $input = input::all();

        } else {

            $user              = New user();
            $user->username    = Input::get('username');
            $user->email       = Input::get('email');
            $user->id_role     = Input::get('id_role');
            $user->id_employee = Input::get('id_employee')>0 ? Input::get('id_employee'): null; 
            $user->password    = Hash::make(Input::get('password'));
            $user->created_date=  date('Y-m-d H:i:s');;
            $user->created_by  = 'System';
            $user->is_active   = 1;

            $user->save();

            return Redirect::to('/user')->with('success', 'Data saved.');
        }
        } catch(QueryException $e){
        	Log::error('Found exception. '.$e);
        	$message = new MessageBag;
        	$message->add('Error', $e->getMessage());
        	return Redirect::to('/user')->withErrors($message);
        }       

		return Redirect::action('UserController@index');
	}
	/**
	* Show the form for editing the specified resource.
	*
	* @param  int  $id
	* @return Response
	*/
	public function edit($id)
	{
		$data = User::find($id);
        $list_role = Role::orderBy('name')->lists('name', 'Id')->all();
        $list_employee = Employee_Profile::orderBy('name')->lists('name', 'Id')->all();
        $data_employee = DB::select('select id, nip, name, sex,harbour_master_name, email01 from vw_employee_profile ');     
        
		if($data){
            $emp = Employee_Profile::find($data->id_employee);            
            $selected_employee = "";
            if(!empty($emp)){
                $selected_employee= $emp->nip." - ".$emp->name;
            }
			return View::make('user.edit')->with('data', $data)->with('list_role', $list_role)->with('list_employee', $list_employee)->with('data_employee', $data_employee)->with('selected_employee', $selected_employee);
		} else {
			return Redirect::action('UserController@index');
		}
	}
	/**
	* Update the specified resource in storage.
	*
	* @param  int  $id
	* @return Response
	*/
	public function update()
	{
		try{

		$rules = array(
            // 'realname' => 'required',
            'username' => 'required|alpha_num|min:4|max:32',
            // 'password' => 'required|min:5|confirmed',
            // 'password_confirmation' => 'required',
            'email' => 'required',
            'id_role' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();

            $input = input::all();

        } else {        	

            $id 		 = Input::get('id');
            // $realname    = Input::get('realname');
            $username    = Input::get('username');
            $email       = Input::get('email');
            // $password    = Input::get('password');
            $id_role     = Input::get('id_role');
            $id_employee = Input::get('id_employee')>0 ? Input::get('id_employee'): null; 
            $is_active	 = Input::get('is_active') != null? 1 : 0;

            User::where('Id',$id)->update(
            	array(	'username' => $username,
            		   	// 'password' => Hash::make($password),
            		   	// 'RealName' => $realname,
                        'email'   => $email,
            		   	'id_role' => $id_role,
            		   	'id_employee' => $id_employee,
            		   	'is_active' => $is_active,
            		   	'updated_date' => date('Y-m-d H:i:s'),
            		   	'updated_by' => 'System'	)
            	);

            return Redirect::to('/user')->with('success', 'Data saved.');
        }
        } catch(QueryException $e){
        	Log::error('Found exception. '.$e);
        	$message = new MessageBag;
        	$message->add('Error', $e->getMessage());
        	return Redirect::to('/user')->withErrors($message);
        }       

		return Redirect::to('/user');
	}

    public function reset_password($user_id = null){
        if($user_id != null && $user_id > 0){
            if(!Auth::user()->roles->is_admin){
                $user_id =Auth::user()->id;
            }
        } else {
            $user_id =Auth::user()->id;
        }

        return View::make('user.reset_password')->with('user_id',$user_id);
    }

    public function save_password(){
        try{

        $rules = array(
            // 'realname' => 'required',
            // 'username' => 'required|alpha_num|min:4|max:32',
            'user_id'  => 'required' ,
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required',
            // 'id_role' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();

            $input = input::all();

        } else {            

            $id          = Input::get('user_id');
            // $realname    = Input::get('realname');
            // $username    = Input::get('username');
            $password    = Input::get('password');
            // $id_role     = Input::get('id_role');
            // $id_employee = Input::get('id_employee');
            // $is_active   = Input::get('is_active') != null? 1 : 0;

            User::where('Id',$id)->update(
                array(  'password' => Hash::make($password),
                        // 'RealName' => $realname,
                        // 'id_role' => $id_role,
                        // 'id_employee' => $id_employee,
                        // 'is_active' => $is_active,
                        'updated_date' => date('Y-m-d H:i:s'),
                        'updated_by' => 'System'    )
                );

            return Redirect::to('/user')->with('success', 'Data saved.');
        }
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('/user')->withErrors($message);
        }       

        return Redirect::to('/user');

    }


	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return Response
	*/
	public function delete($id)
	{
		try{

		$rules = array();

        $validator = Validator::make(Input::all(), $rules);
		$user = User::find($id);
		if(!empty($user) && $user->Username == 'root'){
			$message = $validator->errors();
			$message->add('Username', 'Cannot delete root user.');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
		} else {
			$user->destroy($id);
			return Redirect::to('user');					
		}

        } catch(QueryException $e){
        	Log::error('Found exception. '.$e);
        	$message = new MessageBag;
        	$message->add('Error', $e->getMessage());
        	return Redirect::to('/user')->withErrors($message);
        }
	}
}