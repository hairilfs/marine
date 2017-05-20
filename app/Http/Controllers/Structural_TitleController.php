<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Structural_Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

use \View;

class Structural_TitleController extends BaseController {

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

		$data = Structural_Title::orderBy('id')->get();		
        $list_structural_title = Structural_Title::orderBy('name')->lists('name', 'Id')->all();
		return View::make('structural_title.index')->with('data',$data);
	}

	public function view()
	{
		$data = Structural_Title::orderBy('id')->get();		
		return View::make('structural_title.view')->with('data',$data);
	}
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function add()
    {
        $list_structural_title = Structural_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        return View::make('structural_title.add')->with('list_structural_title', $list_structural_title)->with('list_status', $list_status);
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
            $data = Structural_Title::where('name', '=', Input::get('name'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Name', 'Nama '.Input::get('name').' sudah ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $structural_title = new Structural_Title();
            $structural_title->name = Input::get('name');
            $structural_title->description = Input::get('description');
            $structural_title->level = Input::get('level');
            $structural_title->upper_level = Input::get('upper_level');
            $structural_title->upper_id = Input::get('upper_id')>0 ? Input::get('upper_id'): null;
            $structural_title->status = Input::get('status');
            $structural_title->created_date = date('Y-m-d H:i:s');
            $structural_title->created_by = 'System';

            $structural_title->save();

            return Redirect::to('/structural_title')->with('success', 'Data tersimpan.');
        }
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        return Redirect::to('structural_title')->withErrors($message);
    }       

		return Redirect::to('/structural_title');
	}

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $data = Structural_Title::find($id);
        $list_structural_title = Structural_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        if($data){            
            return View::make('structural_title.edit')->with('data', $data)->with('list_structural_title', $list_structural_title)->with('list_status', $list_status);
        } else {
            return Redirect::action('Structural_TitleController@index');
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
            $data = Structural_Title::where('id', '!=', Input::get('id'))->where('name', '=', Input::get('name'))->first();
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

            Structural_Title::where('id',$id)->update(
                array(  'name' => $name,
                        'description' => $description,  
                        'level'       => $level,  
                        'upper_level' => $upper_level,  
                        'upper_id'    => $upper_id,  
                        'status'      => $status,
                        'updated_date'=> date('Y-m-d H:i:s'),
                        'updated_by'  => 'System' )
                );

            return Redirect::to('/structural_title')->with('success', 'Data tersimpan.');
        }
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('structural_title')->withErrors($message);
        }       

        return Redirect::to('/structural_title');
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
            $structural_title = Structural_Title::find($id);
            $structural_title->destroy($id);
            return Redirect::to('structural_title');
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('/structural_title')->withErrors($message);
        }
    }

    public function detail($id){
        $data = Structural_Title::find($id);
        $list_status = $this->get_list_status();
        $list_structural_title = Structural_Title::orderBy('name')->lists('name', 'Id')->all();
        return View::make('structural_title.detail')->with('data',$data)->with('list_status', $list_status)->with('list_structural_title', $list_structural_title);
    }


}