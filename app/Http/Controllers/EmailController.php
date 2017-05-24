<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Employee_Profile;
use App\Jobs\SendEmail;

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

use \Mail;
use \View;

class EmailController extends BaseController {

    public function __construct()
    {
        $this->middleware('auth');
    }

	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/
	public function index()	{ 
		return View::make('email.index');
	}


	public function send_email_all(Request $request) { 
		try {

			$rules = array(
	            'subject' => 'required',
	            'message' => 'required'
	        );

	        $validator = Validator::make(Input::all(), $rules);

	        // upload
	        $_file_name = "";
	        if ($request->hasFile('attach')) {
		        $file = $request->file('attach');
		        $_file_name = $file->getClientOriginalName();
		        $destination_path = public_path('files/');

		        $file->move($destination_path, $_file_name);
			}

	        //custom validation

	        // if the validator fails, redirect back to the form
	        if ($validator->fails()) {
	            return Redirect::back()
	                ->withErrors($validator) // send back all errors to the login form
	                ->withInput();

	            $input = input::all();

	        } else {
	            
	            //send email
            	// $name = Auth::user()->employee_profile != null? Auth::user()->employee_profile->name: Auth::user()->username;
            	// $email = Auth::user()->email != null ? Auth::user()->email : (Auth::user()->employee_profile != null ? Auth::user()->employee_profile->email01 : "administrator@mail.com") ;
	            // $emp_profile = Employee_Profile::all();
	            // foreach ($emp_profile as $emp) {
	            // 	$target_name = $emp->name;
	            // 	$target_email = $emp->email01 != null? $emp->email01: $emp->email02;
	            // 	$target_email = filter_var($target_email, FILTER_VALIDATE_EMAIL); //filter_var($emp->email01 != null? $emp->email01: $emp->email02, FILTER_VALIDATE_EMAIL);
	            	// $subject = Input::get('subject');
	            // 	$body_message =  htmlentities(Input::get('message'));
	            	// $body_message =  Input::get('message');
	            // 	if($target_email ){

	            // 		try{
	            // 			Mail::later(5, 'email.template', array('body_message' => $body_message, 'subject' => $subject, 'target_name' => $target_name ), function($message) use ($subject, $name, $email, $target_email, $target_name) {
	            // 				$message->from($email, $name);
	            // 				$message->to($target_email, $target_name)->subject($subject);
	            // 			});
	            // 		} catch(Exception $ie){ }
	            // 	}
	            // }

            	$subject = Input::get('subject');
            	$body_message =  Input::get('message');

            	$data_email = explode(',', Input::get('email'));

	     //        $data_email = array(
	     //        		// 'evawandamiranti15@gmail.com',
						// // 'gojek.jkte4746z@gmail.com',
						// // 'lhoryawidiasari15@gmail.com',
						// // 'nukeglam75@gmail.com',
						// // 'pajarseptianto01@gmail.com',
						// 'hairilfiqri@gmail.com',
						// // 'ainiadla@gmail.com'
	     //        	);

	            $sender_name = Auth::user()->employee_profile != null? Auth::user()->employee_profile->name: Auth::user()->username;
            	$sender_email = Auth::user()->email != null ? Auth::user()->email : (Auth::user()->employee_profile != null ? Auth::user()->employee_profile->email01 : "administrator@mail.com") ;

	            foreach ($data_email as $key => $value) {		

		            try{
	            // dd(asset('files/'.$_file_name));       	
		            	$target_email = $value;
		            	$target_name = 'John Doe';
	        			// Mail::send('email.template', array('body_message' => $body_message, 'subject' => $subject, 'target_name' => $target_name ), function($message) use ($subject, $name, $email, $target_email, $target_name, $_file_name) {
	        			// 	$message->from($email, $name);
	        			// 	$message->to($target_email, $target_name)->subject($subject);
	        			// 	$message->attach(public_path('files/'.$_file_name));
	        			// });

	        			$all_data = [
	        				'sender_email' => $sender_email, 
	        				'sender_name' => $sender_name, 
	        				'target_email' => $target_email,
	        				'target_name' =>  $target_name,
	        				'body_message' => $body_message, 
	        				'subject' => $subject
	        			];

	        			if ($request->hasFile('attach')) {
	        				$all_data['file'] = $_file_name;
	        			}

	        			$this->dispatch(new SendEmail($all_data));
	        				// ->delay(60);


	        		} catch(Exception $ie){

	        		}
	            }
           
	            // return Redirect::to('/emp_training')->with('success', 'Data tersimpan.');
				return View::make('email.success')->with('message', 'Email sent');
	        }
	        
	    } catch(QueryException $e){
	        Log::error('Found exception. '.$e);
	        $message = new MessageBag;
	        $message->add('Error', $e->getMessage());
	        return Redirect::action('EmailController@index')->withErrors($message);
	    }       
	}

	public function success(){
		return View::make('email.success')->with('message', 'Email sent');
	}

	public function view()
	{
		return View::make('email.view');
	}



}