<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Doc_Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

use \View;

class Doc_TypeController extends BaseController {

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

		$data = Doc_Type::orderBy('id')->get();		
		return View::make('doc_type.index')->with('data',$data);
	}

	public function view()
	{
		$data = Doc_Type::orderBy('id')->get();		
		return View::make('doc_type.view')->with('data',$data);
	}
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function add()
    {
        $list_status = $this->get_list_status();
        return View::make('doc_type.add')->with('list_status', $list_status);
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
            'name' => 'required',
            'status' => 'required'
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
            $data = Doc_Type::where('name', '=', Input::get('name'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Name', 'Nama '.Input::get('name').' sudah ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $doc_type = new Doc_Type();
            $doc_type->name = Input::get('name');
            $doc_type->description = Input::get('description');
            $doc_type->status = Input::get('status');
            $doc_type->created_date = date('Y-m-d H:i:s');
            $doc_type->created_by = 'System';

            $doc_type->save();

            return Redirect::to('/doc_type')->with('success', 'Data tersimpan.');
        }
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        return Redirect::to('doc_type')->withErrors($message);
    }       

		return Redirect::to('/doc_type');
	}

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $data = Doc_Type::find($id);
        $list_status = $this->get_list_status();
        if($data){            
            return View::make('doc_type.edit')->with('data', $data)->with('list_status', $list_status);
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
            'status' => 'required'
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
            $data = Doc_Type::where('id', '!=', Input::get('id'))->where('name', '=', Input::get('name'))->first();
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

            Doc_Type::where('id',$id)->update(
                array(  'name' => $name,
                        'description' => $description,  
                        'status'    => $status,
                        'updated_date' => date('Y-m-d H:i:s'),
                        'updated_by' => 'System' )
                );

            return Redirect::to('/doc_type')->with('success', 'Data tersimpan.');
        }
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('doc_type')->withErrors($message);
        }       

        return Redirect::to('/doc_type');
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
            $doc_type = Doc_Type::find($id);
            $doc_type->destroy($id);
            return Redirect::to('doc_type');
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('/doc_type')->withErrors($message);
        }
    }

    public function detail($id){
        $data = Doc_Type::find($id);        
        $list_status = $this->get_list_status();
        return View::make('doc_type.detail')->with('data',$data)->with('list_status', $list_status);
    }


}