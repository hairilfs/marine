<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Harbour_Master;
use App\Model\Harbour_Area;
use App\Model\Harbour_Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

use \View;

class Harbour_MasterController extends BaseController {

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
		// $data = Harbour_Master::orderBy('name')->get();		
        $data = DB::select('select * from vw_harbour_master ');      
		return View::make('harbour_master.index')->with('data',$data);
	}

	public function view()
	{
		// $data = Harbour_Master::orderBy('name')->get();		
        $data = DB::select('select * from vw_harbour_master '); 
		return View::make('harbour_master.view')->with('data',$data);
	}
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function add()
    {
        $list_harbour_area = Harbour_Area::orderBy('name')->lists('name', 'Id')->all();
        $list_harbour_grade = Harbour_Grade::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        return View::make('harbour_master.add')->with('list_harbour_area', $list_harbour_area)->with('list_status', $list_status)->with('list_harbour_grade', $list_harbour_grade);
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
            'id_harbour_area' => 'required',
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
            $data = Harbour_Master::where('name', '=', Input::get('name'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Name', 'Name '.Input::get('name').' sudah ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $harbour_master = new Harbour_Master();
            $harbour_master->id_harbour_area = Input::get('id_harbour_area');
            $harbour_master->name = Input::get('name');
            $harbour_master->phone1 = Input::get('phone1');
            $harbour_master->phone2 = Input::get('phone2');
            $harbour_master->phone3 = Input::get('phone3');
            $harbour_master->address01 = Input::get('address01');
            $harbour_master->address02 = Input::get('address02');
            $harbour_master->address03 = Input::get('address03');
            $harbour_master->city = Input::get('city');
            $harbour_master->zipcode = Input::get('zipcode');
            $harbour_master->email = Input::get('email');
            $harbour_master->web_address = Input::get('web_address');
            $harbour_master->id_grade = Input::get('id_grade');
            $harbour_master->description = Input::get('description');
            $harbour_master->status = Input::get('status');
            $harbour_master->created_date = date('Y-m-d H:i:s');
            $harbour_master->created_by = 'System';

            $harbour_master->save();

            return Redirect::to('/harbour_master')->with('success', 'Data tersimpan.');
        }
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        return Redirect::to('harbour_master')->withErrors($message);
    }       

		return Redirect::to('/harbour_master');
	}

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $data = Harbour_Master::find($id);
        $list_harbour_grade = Harbour_Grade::orderBy('name')->lists('name', 'Id')->all();
        $list_harbour_area = Harbour_Area::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        if($data){            
            return View::make('harbour_master.edit')->with('data', $data)->with('list_harbour_area', $list_harbour_area)->with('list_harbour_grade', $list_harbour_grade)->with('list_status', $list_status);
        } else {
            return Redirect::action('Harbour_MasterController@index');
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
            'id_harbour_area' => 'required',
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
            $data = Harbour_Master::where('id', '!=', Input::get('id'))->where('name', '=', Input::get('name'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Name', 'Name '.Input::get('name').' sudah  ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $id             = Input::get('id');
            $id_harbour_area= Input::get('id_harbour_area');
            $name           = Input::get('name');
            $phone1         = Input::get('phone1');
            $phone2         = Input::get('phone2');
            $phone3         = Input::get('phone3');
            $address01      = Input::get('address01');
            $address02      = Input::get('address02');
            $address03      = Input::get('address03');
            $city           = Input::get('city');
            $zipcode        = Input::get('zipcode');
            $email          = Input::get('email');
            $web_address    = Input::get('web_address');
            $id_grade     		= Input::get('id_grade');
            $description    = Input::get('description');
            $status      	= Input::get('status');

            Harbour_Master::where('id',$id)->update(
                array(  
                        'id_harbour_area'        => $id_harbour_area,
                        'name'        => $name,
                        'phone1' => $phone1,  
                        'phone2' => $phone2,  
                        'phone3' => $phone3,  
                        'address01' => $address01,  
                        'address02' => $address02,  
                        'address03' => $address03,  
                        'city' => $city,  
                        'zipcode' => $zipcode,  
                        'email' => $email,  
                        'web_address' => $web_address,  
                        'id_grade' => $id_grade,  
                        'description' => $description,  
                        'status'      => $status,
                        'updated_date'=> date('Y-m-d H:i:s'),
                        'updated_by'  => 'System' )
                );

            return Redirect::to('/harbour_master')->with('success', 'Data tersimpan.');
        }
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('harbour_master')->withErrors($message);
        }       

        return Redirect::to('/harbour_master');
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
            $harbour_master = Harbour_Master::find($id);
            $harbour_master->destroy($id);
            return Redirect::to('harbour_master');
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('/harbour_master')->withErrors($message);
        }
    }

    public function detail($id){
        $data = Harbour_Master::find($id);
        $list_status = $this->get_list_status();
        $list_harbour_area = Harbour_Area::orderBy('name')->lists('name', 'Id')->all();
        $list_harbour_grade = Harbour_Grade::orderBy('name')->lists('name', 'Id')->all();
        return View::make('harbour_master.detail')->with('data',$data)->with('list_status', $list_status)->with('list_harbour_area', $list_harbour_area)->with('list_harbour_grade', $list_harbour_grade);
    }


}