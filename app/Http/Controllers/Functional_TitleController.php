<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Functional_Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

use \View;

class Functional_TitleController extends BaseController {

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

		$data = Functional_Title::orderBy('id')->get();		
		return View::make('functional_title.index')->with('data',$data);
	}

	public function view()
	{
		$data = Functional_Title::orderBy('id')->get();		
		return View::make('functional_title.view')->with('data',$data);
	}
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function add()
    {
        $list_functional_title = Functional_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        return View::make('functional_title.add')->with('list_functional_title', $list_functional_title)->with('list_status', $list_status);
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
            // 'level' => 'required',
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
            $data = Functional_Title::where('name', '=', Input::get('name'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Name', 'Nama '.Input::get('name').' sudah ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $functional_title = new Functional_Title();
            $functional_title->name = Input::get('name');
            $functional_title->description = Input::get('description');
            $functional_title->level = Input::get('level');
            $functional_title->upper_level = Input::get('upper_level');
            $functional_title->upper_id = Input::get('upper_id')>0 ? Input::get('upper_id'): null;
            $functional_title->status = Input::get('status');
            $functional_title->created_date = date('Y-m-d H:i:s');
            $functional_title->created_by = 'System';

            $functional_title->save();

            return Redirect::to('/functional_title')->with('success', 'Data tersimpan.');
        }
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        return Redirect::to('functional_title')->withErrors($message);
    }       

		return Redirect::to('/functional_title');
	}

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $data = Functional_Title::find($id);
        $list_functional_title = Functional_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        if($data){            
            return View::make('functional_title.edit')->with('data', $data)->with('list_functional_title', $list_functional_title)->with('list_status', $list_status);
        } else {
            return Redirect::action('Functional_TitleController@index');
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
            // 'level' => 'required',
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
            $data = Functional_Title::where('id', '!=', Input::get('id'))->where('name', '=', Input::get('name'))->first();
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
            $level          = Input::get('level');
            $upper_level    = Input::get('upper_level');  
            $upper_id       = Input::get('upper_id')>0 ? Input::get('upper_id'): null;
            $status      	= Input::get('status');

            Functional_Title::where('id',$id)->update(
                array(  'name' => $name,
                        'description' => $description,  
                        'level'       => $level,  
                        'upper_level' => $upper_level,  
                        'upper_id'    => $upper_id,  
                        'status'      => $status,
                        'updated_date'=> date('Y-m-d H:i:s'),
                        'updated_by'  => 'System' )
                );

            return Redirect::to('/functional_title')->with('success', 'Data tersimpan.');
        }
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('functional_title')->withErrors($message);
        }       

        return Redirect::to('/functional_title');
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
            $functional_title = Functional_Title::find($id);
            $functional_title->destroy($id);
            return Redirect::to('functional_title');
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('/functional_title')->withErrors($message);
        }
    }

    public function detail($id){
        $data = Functional_Title::find($id);
        $list_functional_title = Functional_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        return View::make('functional_title.detail')->with('data',$data)->with('list_status', $list_status)->with('list_functional_title', $list_functional_title);
    }


}