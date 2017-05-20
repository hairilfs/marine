<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
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

class Harbour_GradeController extends BaseController {

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

		$data = Harbour_Grade::orderBy('id')->get();		
		return View::make('harbour_grade.index')->with('data',$data);
	}

	public function view()
	{
		$data = Harbour_Grade::orderBy('id')->get();		
		return View::make('harbour_grade.view')->with('data',$data);
	}
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function add()
    {
        $list_status = $this->get_list_status();
        return View::make('harbour_grade.add')->with('list_status', $list_status);
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
            'code' => 'required',
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
            $data = Harbour_Grade::where('code', '=', Input::get('code'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Code', 'Code '.Input::get('code').' sudah ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $harbour_grade = new Harbour_Grade();
            $harbour_grade->code = Input::get('code');
            $harbour_grade->name = Input::get('name');
            $harbour_grade->description = Input::get('description');
            // $harbour_grade->status = Input::get('status');
            $harbour_grade->created_date = date('Y-m-d H:i:s');
            $harbour_grade->created_by = 'System';

            $harbour_grade->save();

            return Redirect::to('/harbour_grade')->with('success', 'Data tersimpan.');
        }
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        return Redirect::to('harbour_grade')->withErrors($message);
    }       

		return Redirect::to('/harbour_grade');
	}

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $data = Harbour_Grade::find($id);
        $list_status = $this->get_list_status();
        if($data){            
            return View::make('harbour_grade.edit')->with('data', $data)->with('list_status', $list_status);
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
            'code' => 'required',
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
            $data = Harbour_Grade::where('id', '!=', Input::get('id'))->where('code', '=', Input::get('code'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Code', 'Code '.Input::get('code').' sudah  ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $id             = Input::get('id');
            // $code           = Input::get('code');
            $name      		= Input::get('name');
            $description    = Input::get('description');
            // $status      	= Input::get('status');

            Harbour_Grade::where('id',$id)->update(
                array(  'name' => $name,
                        'description' => $description,  
                        // 'status'    => $status,
                        'updated_date' => date('Y-m-d H:i:s'),
                        'updated_by' => 'System' )
                );

            return Redirect::to('/harbour_grade')->with('success', 'Data tersimpan.');
        }
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('harbour_grade')->withErrors($message);
        }       

        return Redirect::to('/harbour_grade');
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
            $harbour_grade = Harbour_Grade::find($id);
            $harbour_grade->destroy($id);
            return Redirect::to('harbour_grade');
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('/harbour_grade')->withErrors($message);
        }
    }

    public function detail($id){
        $data = Harbour_Grade::find($id);
        $list_status = $this->get_list_status();
        return View::make('harbour_grade.detail')->with('data',$data)->with('list_status', $list_status);
    }


}