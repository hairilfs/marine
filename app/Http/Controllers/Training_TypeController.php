<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Training_Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

use \View;

class Training_TypeController extends BaseController {

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

		$data = Training_Type::orderBy('id')->get();		
		return View::make('training_type.index')->with('data',$data);
	}

	public function view()
	{
		$data = Training_Type::orderBy('id')->get();		
		return View::make('training_type.view')->with('data',$data);
	}
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function add()
    {
        $list_status = $this->get_list_status();
        $list_refreshment = $this->get_list_refreshment();
        return View::make('training_type.add')->with('list_status', $list_status)->with('list_refreshment', $list_refreshment);
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
            $data = Training_Type::where('name', '=', Input::get('name'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Name', 'Nama '.Input::get('name').' sudah ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $training_type = new Training_Type();
            $training_type->name = Input::get('name');
            $training_type->description = Input::get('description');
            $training_type->refreshment = Input::get('refreshment') != null? 1 : 0;
            $training_type->status = Input::get('status') != null? 1 : 0;
            $training_type->created_date = date('Y-m-d H:i:s');
            $training_type->created_by = 'System';

            $training_type->save();

            return Redirect::to('/training_type')->with('success', 'Data tersimpan.');
        }
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        return Redirect::to('training_type')->withErrors($message);
    }       

		return Redirect::to('/training_type');
	}

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $data = Training_Type::find($id);
        $list_status = $this->get_list_status();
        $list_refreshment = $this->get_list_refreshment();
        if($data){            
            return View::make('training_type.edit')->with('data', $data)->with('list_status', $list_status)->with('list_refreshment', $list_refreshment);
        } else {
            return Redirect::action('Training_TypeController@index');
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
            $data = Training_Type::where('id', '!=', Input::get('id'))->where('name', '=', Input::get('name'))->first();
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
            // $refreshment    = Input::get('refreshment') != null && Input::get('refreshment') != ''?Input::get('refreshment'): (int)null;
            $refreshment    = Input::get('refreshment') != null? 1 : 0;
            $status         = Input::get('status') != null? 1 : 0;

            Training_Type::where('id',$id)->update(
                array(  'name' => $name,
                        'description' => $description,  
                        'refreshment' => $refreshment,  
                        'status'      => $status,
                        'updated_date'=> date('Y-m-d H:i:s'),
                        'updated_by'  => 'System' )
                );

            return Redirect::to('/training_type')->with('success', 'Data tersimpan.');
        }
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('training_type')->withErrors($message);
        }       

        return Redirect::to('/training_type');
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
            $training_type = Training_Type::find($id);
            $training_type->destroy($id);
            return Redirect::to('training_type');
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('/training_type')->withErrors($message);
        }
    }

    public function detail($id){
        $data = Training_Type::find($id);
        $list_status = $this->get_list_status();
        $list_refreshment = $this->get_list_refreshment();
        return View::make('training_type.detail')->with('data',$data)->with('list_status', $list_status)->with('list_refreshment', $list_refreshment);
    }


}