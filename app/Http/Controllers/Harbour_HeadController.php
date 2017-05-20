<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Harbour_Head;
use App\Model\Harbour_Master;
use App\Model\Employee_Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

use \View;

class Harbour_HeadController extends BaseController {

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

		// $data = Harbour_Head::orderBy('id')->get();		
        $data = DB::select('select * from vw_harbour_head ');      
		return View::make('harbour_head.index')->with('data',$data);
	}

	public function view()
	{
		// $data = Harbour_Head::orderBy('id')->get();		
        $data = DB::select('select * from vw_harbour_head ');      
		return View::make('harbour_head.view')->with('data',$data);
	}
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function add()
    {
        $list_status = $this->get_list_status();
        $list_harbour_master = Harbour_Master::orderBy('name')->lists('name', 'Id')->all();
        $list_employee_profile = Employee_Profile::orderBy('name')->lists('name', 'Id')->all();
        return View::make('harbour_head.add')->with('list_status', $list_status)->with('list_harbour_master', $list_harbour_master)->with('list_employee_profile', $list_employee_profile);
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
            'id_harbour' => 'required',
            'id_emp' => 'required'
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
            $data = Harbour_Head::where('id_emp', '=', Input::get('id_emp'))->where('id_harbour', '=', Input::get('id_harbour'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Head', 'Employee untuk wilayah kerja tersebut sudah terdaftar.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $harbour_head = new Harbour_Head();
            $harbour_head->id_harbour = Input::get('id_harbour');
            $harbour_head->id_emp = Input::get('id_emp');
            $harbour_head->created_date = date('Y-m-d H:i:s');
            $harbour_head->created_by = 'System';

            $harbour_head->save();

            return Redirect::to('/harbour_head')->with('success', 'Data tersimpan.');
        }
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        return Redirect::to('harbour_head')->withErrors($message);
    }       

		return Redirect::to('/harbour_head');
	}

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $data = Harbour_Head::find($id);
        $list_status = $this->get_list_status();
        $list_harbour_master = Harbour_Master::orderBy('name')->lists('name', 'Id')->all();
        $list_employee_profile = Employee_Profile::orderBy('name')->lists('name', 'Id')->all();
        if($data){            
            return View::make('harbour_head.edit')->with('data', $data)->with('list_status', $list_status)->with('list_harbour_master', $list_harbour_master)->with('list_employee_profile', $list_employee_profile);
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
            'id_harbour' => 'required',
            'id_emp' => 'required'
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
            $data = Harbour_Head::where('id', '!=', Input::get('id'))->where('id_emp', '=', Input::get('id_emp'))->where('id_harbour', '=', Input::get('id_harbour'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Head', 'Employee untuk wilayah kerja tersebut sudah terdaftar.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $id             = Input::get('id');
            $id_emp    		= Input::get('id_emp');
            $id_harbour     = Input::get('id_harbour');
            $status      	= Input::get('status');

            Harbour_Head::where('id',$id)->update(
                array(  'id_emp' => $id_emp,
                        'id_harbour' => $id_harbour,  
                        'updated_date' => date('Y-m-d H:i:s'),
                        'updated_by' => 'System' )
                );

            return Redirect::to('/harbour_head')->with('success', 'Data tersimpan.');
        }
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('harbour_head')->withErrors($message);
        }       

        return Redirect::to('/harbour_head');
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
            $harbour_head = Harbour_Head::find($id);
            $harbour_head->destroy($id);
            return Redirect::to('harbour_head');
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('/harbour_head')->withErrors($message);
        }
    }

    public function detail($id){
        $data = Harbour_Head::find($id);
        $list_status = $this->get_list_status();
        $list_harbour_master = Harbour_Master::orderBy('name')->lists('name', 'Id')->all();
        $list_employee_profile = Employee_Profile::orderBy('name')->lists('name', 'Id')->all();
        return View::make('harbour_head.detail')->with('data',$data)->with('list_status', $list_status)->with('list_harbour_master', $list_harbour_master)->with('list_employee_profile', $list_employee_profile);
    }


}