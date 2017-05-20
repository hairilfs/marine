<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
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

class Shipping_CompanyController extends BaseController {

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

		$data = Shipping_Company::orderBy('id')->get();		
		return View::make('shipping_company.index')->with('data',$data);
	}

	public function view()
	{
		$data = Shipping_Company::orderBy('id')->get();		
		return View::make('shipping_company.view')->with('data',$data);
	}
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function add()
    {
        $list_status = $this->get_list_status();
        $list_grade = $this->get_list_shipping_company_grade();
        $list_region = $this->get_list_region();
        $list_shipping_company = Shipping_Company::orderBy('name')->lists('name', 'Id')->all();
        return View::make('shipping_company.add')->with('list_status', $list_status)->with('list_grade', $list_grade)->with('list_region', $list_region)->with('list_shipping_company', $list_shipping_company);
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
            'reg_no' => 'required',
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
            $data = Shipping_Company::where('reg_no', '=', Input::get('reg_no'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Registration Number', 'Registration Number '.Input::get('reg_no').' sudah ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $shipping_company = new Shipping_Company();
            $shipping_company->reg_no = Input::get('reg_no');
            $shipping_company->name = Input::get('name');
            $shipping_company->phone1 = Input::get('phone1');
            $shipping_company->phone2 = Input::get('phone2');
            $shipping_company->phone3 = Input::get('phone3');
            $shipping_company->address01 = Input::get('address01');
            $shipping_company->address02 = Input::get('address02');
            $shipping_company->address03 = Input::get('address03');
            $shipping_company->city = Input::get('city');
            $shipping_company->zipcode = Input::get('zipcode');
            $shipping_company->email01 = Input::get('email01');
            $shipping_company->email02 = Input::get('email02');
            $shipping_company->grade = Input::get('grade');
            $shipping_company->description = Input::get('description');
            $shipping_company->location = Input::get('location');
            $shipping_company->branch = Input::get('branch');
            $shipping_company->upper_id = Input::get('upper_id');
            $shipping_company->status = Input::get('status');
            $shipping_company->created_date = date('Y-m-d H:i:s');
            $shipping_company->created_by = 'System';

            $shipping_company->save();

            return Redirect::to('/shipping_company')->with('success', 'Data tersimpan.');
        }
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        return Redirect::to('shipping_company')->withErrors($message);
    }       

		return Redirect::to('/shipping_company');
	}

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $data = Shipping_Company::find($id);
        $list_status = $this->get_list_status();
        $list_grade = $this->get_list_shipping_company_grade();
        $list_region = $this->get_list_region();
        $list_shipping_company = Shipping_Company::orderBy('name')->lists('name', 'Id')->all();
        if($data){            
            return View::make('shipping_company.edit')->with('data', $data)->with('list_status', $list_status)->with('list_grade', $list_grade)->with('list_region', $list_region)->with('list_shipping_company', $list_shipping_company);
        } else {
            return Redirect::action('Shipping_CompanyController@index');
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
            'reg_no' => 'required',
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
            $data = Shipping_Company::where('id', '!=', Input::get('id'))->where('reg_no', '=', Input::get('reg_no'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Registration  Number', 'Registration Number '.Input::get('reg_no').' sudah  ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $id             = Input::get('id');
            $reg_no         = Input::get('reg_no');
            $name           = Input::get('name');
            $phone1         = Input::get('phone1');
            $phone2         = Input::get('phone2');
            $phone3         = Input::get('phone3');
            $address01      = Input::get('address01');
            $address02      = Input::get('address02');
            $address03      = Input::get('address03');
            $city           = Input::get('city');
            $zipcode        = Input::get('zipcode');
            $email01        = Input::get('email01');
            $email02        = Input::get('email02');
            $grade     		= Input::get('grade');
            $location       = Input::get('location');
            $branch         = Input::get('branch');
            $upper_id       = Input::get('upper_id');
            $description    = Input::get('description');
            $status      	= Input::get('status');

            Shipping_Company::where('id',$id)->update(
                array(  
                        'reg_no'      => $reg_no,
                        'name'        => $name,
                        'phone1' => $phone1,  
                        'phone2' => $phone2,  
                        'phone3' => $phone3,  
                        'address01' => $address01,  
                        'address02' => $address02,  
                        'address03' => $address03,  
                        'city' => $city,  
                        'zipcode' => $zipcode,  
                        'email01' => $email01,  
                        'email02' => $email02,  
                        'grade' => $grade,  
                        'location' => $location,  
                        'branch' => $branch,  
                        'upper_id' => $upper_id,  
                        'description' => $description,  
                        'status'      => $status,
                        'updated_date'=> date('Y-m-d H:i:s'),
                        'updated_by'  => 'System' )
                );

            return Redirect::to('/shipping_company')->with('success', 'Data tersimpan.');
        }
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('shipping_company')->withErrors($message);
        }       

        return Redirect::to('/shipping_company');
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
            $shipping_company = Shipping_Company::find($id);
            $shipping_company->destroy($id);
            return Redirect::to('shipping_company');
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('/shipping_company')->withErrors($message);
        }
    }

    public function detail($id){
        $data = Shipping_Company::find($id);
        $list_status = $this->get_list_status();
        $list_grade = $this->get_list_shipping_company_grade();
        $list_region = $this->get_list_region();
        $list_shipping_company = Shipping_Company::orderBy('name')->lists('name', 'Id')->all();
        return View::make('shipping_company.detail')->with('data',$data)->with('list_status', $list_status)->with('list_grade', $list_grade)->with('list_region', $list_region)->with('list_shipping_company', $list_shipping_company);
    }


}