<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

use \View;

class UniversityController extends BaseController {

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

		$data = University::orderBy('name')->get();		
		return View::make('university.index')->with('data',$data);
	}

	public function view()
	{
		$data = University::orderBy('name')->get();		
		return View::make('university.view')->with('data',$data);
	}
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function add()
    {
        $list_status = $this->get_list_status();
        return View::make('university.add')->with('list_status', $list_status);
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
            'name' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        //custom validation

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();

            $input = input::all();

        } else {

            //custom validation
            $data = University::where('name', '=', Input::get('name'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Name', 'Nama '.Input::get('name').' sudah ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $university = new University();
            $university->name = Input::get('name');
            $university->description = Input::get('description');
            $university->status = Input::get('status');
            $university->created_date = date('Y-m-d H:i:s');
            $university->created_by = 'System';

            $university->save();

            return Redirect::to('/university')->with('success', 'Data tersimpan.');
        }
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        return Redirect::to('university')->withErrors($message);
    }       

		return Redirect::to('/university');
	}

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $data = University::find($id);
        $list_status = $this->get_list_status();
        if($data){            
            return View::make('university.edit')->with('data', $data)->with('list_status', $list_status);
        } else {
            return Redirect::action('UniversityController@index');
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
            'name' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();

            $input = input::all();

        } else {            

            //custom validation
            $data = University::where('id', '!=', Input::get('id'))->where('name', '=', Input::get('name'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Name', 'Nama '.Input::get('name').' sudah  ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $id             = Input::get('id');
            $name      		= Input::get('name');
            $description    = Input::get('description');
            $status      	= Input::get('status');

            University::where('id',$id)->update(
                array(  'name' => $name,
                        'description' => $description,  
                        'status'    => $status,
                        'updated_date' => date('Y-m-d H:i:s'),
                        'updated_by' => 'System' )
                );

            return Redirect::to('/university')->with('success', 'Data tersimpan.');
        }
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('university')->withErrors($message);
        }       

        return Redirect::to('/university');
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
            $university = University::find($id);
            $university->destroy($id);
            return Redirect::to('university');
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('/university')->withErrors($message);
        }
    }

    public function detail($id){
        $data = University::find($id);
        $list_status = $this->get_list_status();
        return View::make('university.detail')->with('data',$data)->with('list_status', $list_status);
    }


}