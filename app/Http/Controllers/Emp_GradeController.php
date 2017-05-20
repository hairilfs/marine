<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Emp_Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

use \View;

class Emp_GradeController extends BaseController {

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

		$data = Emp_Grade::orderBy('id')->get();		
		return View::make('emp_grade.index')->with('data',$data);
	}

	public function view()
	{
		$data = Emp_Grade::orderBy('id')->get();		
		return View::make('emp_grade.view')->with('data',$data);
	}
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function add()
    {
        $list_status = $this->get_list_status();
        return View::make('emp_grade.add')->with('list_status', $list_status);
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
            $data = Emp_Grade::where('name', '=', Input::get('name'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Name', 'Nama '.Input::get('name').' sudah ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $emp_grade = new Emp_Grade();
            $emp_grade->name = Input::get('name');
            $emp_grade->description = Input::get('description');
            $emp_grade->status = Input::get('status');
            $emp_grade->created_date = date('Y-m-d H:i:s');
            $emp_grade->created_by = 'System';

            $emp_grade->save();

            return Redirect::to('/emp_grade')->with('success', 'Data tersimpan.');
        }
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        return Redirect::to('emp_grade')->withErrors($message);
    }       

		return Redirect::to('/emp_grade');
	}

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $data = Emp_Grade::find($id);
        $list_status = $this->get_list_status();
        if($data){            
            return View::make('emp_grade.edit')->with('data', $data)->with('list_status', $list_status);
        } else {
            return Redirect::action('EmpGradeController@index');
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
            $data = Emp_Grade::where('id', '!=', Input::get('id'))->where('name', '=', Input::get('name'))->first();
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

            Emp_Grade::where('id',$id)->update(
                array(  'name' => $name,
                        'description' => $description,  
                        'status'    => $status,
                        'updated_date' => date('Y-m-d H:i:s'),
                        'updated_by' => 'System' )
                );

            return Redirect::to('/emp_grade')->with('success', 'Data tersimpan.');
        }
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('emp_grade')->withErrors($message);
        }       

        return Redirect::to('/emp_grade');
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
            $emp_grade = Emp_Grade::find($id);
            $emp_grade->destroy($id);
            return Redirect::to('emp_grade');
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('/emp_grade')->withErrors($message);
        }
    }

    public function detail($id){
        $data = Emp_Grade::find($id);
        $list_status = $this->get_list_status();
        return View::make('emp_grade.detail')->with('data',$data)->with('list_status', $list_status);
    }


}