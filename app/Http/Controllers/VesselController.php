<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Vessel;
use App\Model\Shipping_Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

use \View;

class VesselController extends BaseController {

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

		$data = Vessel::orderBy('vessel_name')->get();		
		return View::make('vessel.index')->with('data',$data);
	}

	public function view()
	{
		$data = Vessel::orderBy('vessel_name')->get();		
		return View::make('vessel.view')->with('data',$data);
	}
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function add()
    {
        $list_status = $this->get_list_status();
        $list_shipping = Shipping_Company::orderBy('name')->lists('name', 'Id')->all();
        return View::make('vessel.add')->with('list_status', $list_status)->with('list_shipping', $list_shipping);
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
            'vessel_name' => 'required',
            'vessel_type' => 'required',
            'call_sign' => 'required',
            'imo_number' => 'required',
            'mmsi_number' => 'required',
            // 'certificate' => 'required',
            'id_shipping_company' => 'required'
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
            $data = Vessel::where('vessel_name', '=', Input::get('vessel_name'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Name', 'Nama '.Input::get('vessel_name').' sudah ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $vessel = new Vessel();
            $vessel->vessel_name = Input::get('vessel_name');
            $vessel->vessel_type = Input::get('vessel_type');
            $vessel->call_sign = Input::get('call_sign');
            $vessel->imo_number = Input::get('imo_number');
            $vessel->mmsi_number = Input::get('mmsi_number');
            $vessel->certificate = Input::get('certificate');
            $vessel->id_shipping_company = Input::get('id_shipping_company')>0 ? Input::get('id_shipping_company'): null;
            $vessel->description = Input::get('description');
            $vessel->status = Input::get('status');
            $vessel->created_date = date('Y-m-d H:i:s');
            $vessel->created_by = 'System';

            $vessel->save();

            return Redirect::to('/vessel')->with('success', 'Data tersimpan.');
        }
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        return Redirect::to('vessel')->withErrors($message);
    }       

		return Redirect::to('/vessel');
	}

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $data = Vessel::find($id);
        $list_status = $this->get_list_status();
        $list_shipping = Shipping_Company::orderBy('name')->lists('name', 'Id')->all();
        if($data){            
            return View::make('vessel.edit')->with('data', $data)->with('list_status', $list_status)->with('list_shipping', $list_shipping);
        } else {
            return Redirect::action('VesselController@index');
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
            'vessel_name' => 'required',
            'vessel_type' => 'required',
            'call_sign' => 'required',
            'imo_number' => 'required',
            'mmsi_number' => 'required',
            // 'certificate' => 'required',
            'id_shipping_company' => 'required'
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
            $data = Vessel::where('id', '!=', Input::get('id'))->where('vessel_name', '=', Input::get('vessel_name'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Name', 'Nama '.Input::get('vessel_name').' sudah  ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $id             = Input::get('id');
            $vessel_name    = Input::get('vessel_name');
            $vessel_type    = Input::get('vessel_type');
            $call_sign    = Input::get('call_sign');
            $imo_number    = Input::get('imo_number');
            $mmsi_number    = Input::get('mmsi_number');
            $certificate    = Input::get('certificate');
            $id_shipping_company    = Input::get('id_shipping_company')>0 ? Input::get('id_shipping_company'): null;
            $description    = Input::get('description');
            $status      	= Input::get('status');

            Vessel::where('id',$id)->update(
                array(  'vessel_name' => $vessel_name,
                        'vessel_type' => $vessel_type,
                        'call_sign' => $call_sign,
                        'imo_number' => $imo_number,
                        'mmsi_number' => $mmsi_number,
                        'certificate' => $certificate,
                        'id_shipping_company' => $id_shipping_company,
                        'description' => $description,  
                        'status'    => $status,
                        'updated_date' => date('Y-m-d H:i:s'),
                        'updated_by' => 'System' )
                );

            return Redirect::to('/vessel')->with('success', 'Data tersimpan.');
        }
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('vessel')->withErrors($message);
        }       

        return Redirect::to('/vessel');
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
            $vessel = Vessel::find($id);
            $vessel->destroy($id);
            return Redirect::to('vessel');
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('/vessel')->withErrors($message);
        }
    }

    public function detail($id){
        $data = Vessel::find($id);
        $list_status = $this->get_list_status();
        $list_shipping = Shipping_Company::orderBy('name')->lists('name', 'Id')->all();
        return View::make('vessel.detail')->with('data',$data)->with('list_status', $list_status)->with('list_shipping', $list_shipping);
    }


}