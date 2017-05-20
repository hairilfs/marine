<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Emp_Addresses;
use App\Model\Doc_File;
use App\Model\University;
use App\Model\Faculty;
use App\Model\Major;
use App\Model\Education_Level;
use App\Model\Training_Type;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

use \View;

class Emp_AddressesController extends BaseController {

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

		$data = Emp_Addresses::orderBy('id')->get();		
		return View::make('emp_addresses.index')->with('data',$data);
	}

	public function view()
	{
		$data = Emp_Addresses::orderBy('id')->get();		
		return View::make('emp_addresses.view')->with('data',$data);
	}
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function add($employee_profile_id)
    {
        $list_status = $this->get_list_status();
        return View::make('emp_addresses.add')->with('list_status', $list_status)->with('employee_profile_id', $employee_profile_id);
    }
	/**
	* Store a newly created resource in storage.
	*
	* @return Response
	*/
	public function save()
	{
        $employee_profile_id = 0;

		try {

        $employee_profile_id = Input::get('employee_profile_id')>0 ? Input::get('employee_profile_id'): null;

		$rules = array(
            'employee_profile_id' => 'required',
            'jalan' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
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

            $emp_addresses = new Emp_Addresses();
            $emp_addresses->id_emp = $employee_profile_id;
            $emp_addresses->jalan = Input::get('jalan');
            $emp_addresses->kelurahan = Input::get('kelurahan');
            $emp_addresses->kecamatan = Input::get('kecamatan');
            $emp_addresses->kabupaten = Input::get('kabupaten');
            $emp_addresses->provinsi = Input::get('provinsi');
            $emp_addresses->kodepos = Input::get('kodepos');
            $emp_addresses->is_current = Input::get('is_current') != null? 1 : 0;
            $emp_addresses->created_date = date('Y-m-d H:i:s');
            $emp_addresses->created_by = 'System';

            //if set main address, reset another main address to false
            if($emp_addresses->is_current == 1){
                $affect = DB::update('update emp_addresses set is_current = 0 where id_emp = ?', [$employee_profile_id]);
            }

            $emp_addresses->save();

            return Redirect::action('Employee_ProfileController@edit', array('id' => $employee_profile_id))->with('success', 'Data tersimpan.');
        }
        
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        return Redirect::action('Employee_ProfileController@edit', array('id' => $employee_profile_id))->withErrors($message);
    }       
        return Redirect::action('Employee_ProfileController@edit', array('id' => $employee_profile_id));
	}

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id, $employee_profile_id)
    {
        $data = Emp_Addresses::find($id);
        $list_status = $this->get_list_status();
        if($data){            
            return View::make('emp_addresses.edit')->with('data', $data)->with('list_status', $list_status)->with('employee_profile_id', $employee_profile_id);
        } else {
            // return Redirect::action('Emp_AddressesController@index');
            return Redirect::action('Employee_ProfileController@edit', array('id' => $employee_profile_id));
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
        $employee_profile_id = 0;

        try{

        $employee_profile_id = Input::get('employee_profile_id')>0 ? Input::get('employee_profile_id'): null;

        $rules = array(
            'employee_profile_id' => 'required',
            'jalan' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();

            $input = input::all();

        } else {            


            $id                 = Input::get('id');
            $jalan      = Input::get('jalan');  
            $kelurahan      = Input::get('kelurahan');  
            $kecamatan      = Input::get('kecamatan');  
            $kabupaten      = Input::get('kabupaten');  
            $provinsi      = Input::get('provinsi');  
            $kodepos      = Input::get('kodepos');  
            $is_current        = Input::get('is_current') != null? 1 : 0;

            //if set main address, reset another main address to false
            if($is_current == 1){
                $affect = DB::update('update emp_addresses set is_current = 0 where id_emp = ?', [$employee_profile_id]);
            }

            Emp_Addresses::where('id',$id)->update(
                array(  
                        'jalan'         => $jalan,  
                        'kelurahan'         => $kelurahan,  
                        'kecamatan'         => $kecamatan,  
                        'kabupaten'         => $kabupaten,  
                        'provinsi'         => $provinsi,  
                        'kodepos'         => $kodepos,  
                        'is_current'           => $is_current,  
                        // 'status'      => $status,
                        'updated_date'=> date('Y-m-d H:i:s'),
                        'updated_by'  => 'System' )
                );

            return Redirect::action('Employee_ProfileController@edit', array('id' => $employee_profile_id))->with('success', 'Data tersimpan.');
            }
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            // return Redirect::to('emp_addresses')->withErrors($message);
            return Redirect::action('Employee_ProfileController@edit', array('id' => $employee_profile_id))->withErrors($message);
        }       

        // return Redirect::to('/emp_addresses');
        return Redirect::action('Employee_ProfileController@edit', array('id' => $employee_profile_id));
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function delete($id, $employee_profile_id)
    {
        try{
            $emp_addresses = Emp_Addresses::find($id);
            $emp_addresses->destroy($id);
            return Redirect::action('Employee_ProfileController@edit', array('id' => $employee_profile_id));
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::action('Employee_ProfileController@edit', array('id' => $employee_profile_id))->withErrors($message);
        }
    }

    public function detail($id, $employee_profile_id){
        $data = Emp_Addresses::find($id);
        $list_status = $this->get_list_status();
        return View::make('emp_addresses.detail')->with('data',$data)->with('list_status', $list_status)->with('employee_profile_id', $employee_profile_id);
    }

    protected function get_certificate_path(){
        $dir = 'C:\\';
        $data = DB::select('select * from settings where code = "directory.employee.certificate"');
        if(count($data) > 0) $dir = reset($data)->value;
        return $dir;
    }
    protected function get_mi_card_path(){
        $dir = 'C:\\';
        $data = DB::select('select * from settings where code = "directory.employee.mi_card"');
        if(count($data) > 0) $dir = reset($data)->value;
        return $dir;
    }
}