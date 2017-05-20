<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Certificate_Task_Shipping;
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

class Certificate_Task_ShippingController extends BaseController {

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

		$data = Certificate_Task_Shipping::orderBy('name')->get();		
		return View::make('certificate_task_shipping.index')->with('data',$data);
	}

	public function view()
	{
		$data = Certificate_Task_Shipping::orderBy('name')->get();		
		return View::make('certificate_task_shipping.view')->with('data',$data);
	}
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function add()
    {
        $list_status = $this->get_list_status();
        return View::make('certificate_task_shipping.add')->with('list_status', $list_status);
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
            $data = Certificate_Task_Shipping::where('name', '=', Input::get('name'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Name', 'Nama '.Input::get('name').' sudah ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $certificate_task_shipping = new Certificate_Task_Shipping();
            $certificate_task_shipping->name = Input::get('name');
            $certificate_task_shipping->description = Input::get('description');
            $certificate_task_shipping->status = Input::get('status');
            $certificate_task_shipping->created_date = date('Y-m-d H:i:s');
            $certificate_task_shipping->created_by = 'System';

            $certificate_task_shipping->save();

            return Redirect::to('/certificate_task_shipping')->with('success', 'Data tersimpan.');
        }
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        return Redirect::to('certificate_task_shipping')->withErrors($message);
    }       

		return Redirect::to('/certificate_task_shipping');
	}

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $data = Certificate_Task_Shipping::find($id);
        $list_status = $this->get_list_status();
        if($data){            
            return View::make('certificate_task_shipping.edit')->with('data', $data)->with('list_status', $list_status);
        } else {
            return Redirect::action('Certificate_Task_ShippingController@index');
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
            'name' => 'required'
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
            $data = Certificate_Task_Shipping::where('id', '!=', Input::get('id'))->where('name', '=', Input::get('name'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Name', 'Nama '.Input::get('name').' sudah  ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $id             = Input::get('id');
            $name    = Input::get('name');
            $description    = Input::get('description');
            $status      	= Input::get('status');

            Certificate_Task_Shipping::where('id',$id)->update(
                array(  'name' => $name,
                        'description' => $description,  
                        'status'    => $status,
                        'updated_date' => date('Y-m-d H:i:s'),
                        'updated_by' => 'System' )
                );

            return Redirect::to('/certificate_task_shipping')->with('success', 'Data tersimpan.');
        }
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('certificate_task_shipping')->withErrors($message);
        }       

        return Redirect::to('/certificate_task_shipping');
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
            $certificate_task_shipping = Certificate_Task_Shipping::find($id);
            $certificate_task_shipping->destroy($id);
            return Redirect::to('certificate_task_shipping');
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('/certificate_task_shipping')->withErrors($message);
        }
    }

    public function detail($id){
        $data = Certificate_Task_Shipping::find($id);
        $list_status = $this->get_list_status();
        return View::make('certificate_task_shipping.detail')->with('data',$data)->with('list_status', $list_status);
    }


}