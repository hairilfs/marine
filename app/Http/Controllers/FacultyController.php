<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Faculty;
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

class FacultyController extends BaseController {

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

		// $data = Faculty::orderBy('id')->get();		
        $data = DB::select('select * from vw_faculty ');    
		return View::make('faculty.index')->with('data',$data);
	}

	public function view()
	{
		// $data = Faculty::orderBy('id')->get();		
        $data = DB::select('select * from vw_faculty ');    
		return View::make('faculty.view')->with('data',$data);
	}
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function add()
    {
        $list_university = University::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        return View::make('faculty.add')->with('list_university', $list_university)->with('list_status', $list_status);
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
            'id_university' => 'required',
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
            $data = Faculty::where('name', '=', Input::get('name'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Name', 'Nama '.Input::get('name').' sudah ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $faculty = new FacuLty();
            $faculty->id_university = Input::get('id_university');
            $faculty->name = Input::get('name');
            $faculty->description = Input::get('description');
            $faculty->status = Input::get('status');
            $faculty->created_date = date('Y-m-d H:i:s');
            $faculty->created_by = 'System';

            $faculty->save();

            return Redirect::to('/faculty')->with('success', 'Data tersimpan.');
        }
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        return Redirect::to('faculty')->withErrors($message);
    }       

		return Redirect::to('/faculty');
	}

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $data = Faculty::find($id);
        $list_university = University::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        if($data){            
            return View::make('faculty.edit')->with('data', $data)->with('list_university', $list_university)->with('list_status', $list_status);
        } else {
            return Redirect::action('FacultyController@index');
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
            'id_university' => 'required',
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
            $data = Faculty::where('id', '!=', Input::get('id'))->where('name', '=', Input::get('name'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Name', 'Nama '.Input::get('name').' sudah  ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $id             = Input::get('id');
            $id_university   = Input::get('id_university');
            $name      		= Input::get('name');
            $description    = Input::get('description');
            $status      	= Input::get('status');

            Faculty::where('id',$id)->update(
                array(  
                        'id_university' => $id_university,
                        'name' => $name,
                        'description' => $description,  
                        'status'    => $status,
                        'updated_date' => date('Y-m-d H:i:s'),
                        'updated_by' => 'System' )
                );

            return Redirect::to('/faculty')->with('success', 'Data tersimpan.');
        }
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('faculty')->withErrors($message);
        }       

        return Redirect::to('/faculty');
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
            $faculty = Faculty::find($id);
            $faculty->destroy($id);
            return Redirect::to('faculty');
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('/faculty')->withErrors($message);
        }
    }

    public function detail($id){
        $data = Faculty::find($id);
        $list_university = University::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        return View::make('faculty.detail')->with('data',$data)->with('list_status', $list_status)->with('list_university', $list_university);
    }


}