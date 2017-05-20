<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Emp_Training;
use App\Model\Doc_File;
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

class Emp_TrainingController extends BaseController {

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

		$data = Emp_Training::orderBy('id')->get();		
		return View::make('emp_training.index')->with('data',$data);
	}

	public function view()
	{
		$data = Emp_Training::orderBy('id')->get();		
		return View::make('emp_training.view')->with('data',$data);
	}
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function add($employee_profile_id)
    {
        $list_training_type = Training_Type::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        return View::make('emp_training.add')->with('list_status', $list_status)->with('list_training_type', $list_training_type)->with('employee_profile_id', $employee_profile_id);
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
            'id_training' => 'required',
            'employee_profile_id' => 'required',
            'graduate_date' => 'required',
            'graduate_year' => 'required',
            'certificate_no' => 'required'
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
            
            //upload file if any
            $file_certificate_id  = null;
            if(Input::file('certificate_file') != null ){
                $file_certificate_id = $this->upload_new_document(Input::file('certificate_file'), 'Sertifikasi', 'cert');
            }
            $file_mi_card_id  = null;
            if(Input::file('mi_card_file') != null ){
                $file_mi_card_id = $this->upload_new_document(Input::file('mi_card_file'), 'Marine Inspector Card', 'mi_card');
            }

            $emp_training = new Emp_Training();
            $emp_training->id_training = Input::get('id_training')>0 ? Input::get('id_training'): null;
            $emp_training->id_employee_profile = $employee_profile_id;
            $emp_training->date_taken_from = Input::get('date_taken_from');
            $emp_training->date_taken_to = Input::get('date_taken_from');
            $emp_training->graduate_date = Input::get('graduate_date');
            $emp_training->graduate_year = Input::get('graduate_year');
            $emp_training->certificate_no = Input::get('certificate_no');
            $emp_training->mi_card = Input::get('mi_card');
            $emp_training->mi_date = empty(Input::get('mi_date')) || Input::get('mi_date') == ''? null: Input::get('mi_date');
            $emp_training->id_certificate_file = $file_certificate_id;
            $emp_training->id_mi_card_file = $file_mi_card_id;

            $emp_training->description = Input::get('description');
            // $emp_training->refreshment = Input::get('refreshment');
            $emp_training->location = Input::get('location');
            $emp_training->status = Input::get('status');
            $emp_training->created_date = date('Y-m-d H:i:s');
            $emp_training->created_by = 'System';

            $emp_training->save();

            $emp_trainig_id = DB::getPdo()->lastInsertId();
            

            // return Redirect::to('/emp_training')->with('success', 'Data tersimpan.');
            return Redirect::action('Employee_ProfileController@edit', array('id' => $employee_profile_id))->with('success', 'Data tersimpan.');
        }
        
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        // return Redirect::to('emp_training')->withErrors($message);
        return Redirect::action('Employee_ProfileController@edit', array('id' => $employee_profile_id))->withErrors($message);
    }       
        // return Redirect::to('/emp_training');
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
        $data = Emp_Training::find($id);
        $list_training_type = Training_Type::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        if($data){            
            return View::make('emp_training.edit')->with('data', $data)->with('list_status', $list_status)->with('list_training_type', $list_training_type)->with('employee_profile_id', $employee_profile_id);
        } else {
            // return Redirect::action('Emp_TrainingController@index');
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
            'id_training' => 'required',
            'graduate_date' => 'required',
            'graduate_year' => 'required',
            'certificate_no' => 'required'
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
            $id_training      	= Input::get('id_training')>0 ? Input::get('id_training'): null;
            $date_taken_from    = empty(Input::get('date_taken_from')) || Input::get('date_taken_from') == ''? null: Input::get('date_taken_from');  
            $date_taken_to      = empty(Input::get('date_taken_to')) || Input::get('date_taken_to') == ''? null: Input::get('date_taken_to');  
            $graduate_date      = empty(Input::get('graduate_date')) || Input::get('graduate_date') == ''? null: Input::get('graduate_date');     
            $graduate_year      = Input::get('graduate_year');  
            $certificate_no     = Input::get('certificate_no');  
            $mi_card            = Input::get('mi_card');  
            $mi_date            = empty(Input::get('mi_date')) || Input::get('mi_date') == ''? null: Input::get('mi_date');  
            $description        = Input::get('description');  
            // $refreshment        = Input::get('refreshment');  
            $location        = Input::get('location');  
            $status      	    = Input::get('status');

            Emp_Training::where('id',$id)->update(
                array(  'id_training' => $id_training,
                        'date_taken_from' => $date_taken_from,  
                        'date_taken_to'       => $date_taken_to,  
                        'graduate_date' => $graduate_date,  
                        'graduate_year'    => $graduate_year,  
                        'certificate_no'    => $certificate_no,  
                        'mi_card'    => $mi_card,  
                        'mi_date'    => $mi_date,  
                        'description'    => $description,  
                        // 'refreshment'    => $refreshment,  
                        'location'    => $location,  
                        'status'      => $status,
                        'updated_date'=> date('Y-m-d H:i:s'),
                        'updated_by'  => 'System' )
                );

            //upload file document if any
            $emp_training = Emp_Training::find($id);
            if(!empty($emp_training)){
                $existing_certificate_file = Doc_File::find($emp_training->id_certificate_file);
                $existing_mi_card_file = Doc_File::find($emp_training->id_mi_card_file);

                $file_certificate_id  = null;
                if(Input::file('certificate_file') != null ){
                    $file_certificate_id = $this->upload_existing_document(Input::file('certificate_file'), 'Sertifikasi', 'cert', $existing_certificate_file);

                    if($file_certificate_id != null){
                        Emp_Training::where('id',$id)->update(
                            array(  'id_certificate_file' => $file_certificate_id,  
                                    'updated_date'=> date('Y-m-d H:i:s'),
                                    'updated_by'  => 'System' )
                            );                        
                    }
                }
                $file_mi_card_id  = null;
                if(Input::file('mi_card_file') != null){
                    $file_mi_card_id = $this->upload_existing_document(Input::file('mi_card_file'), 'Marine Inspector Card', 'mi_card' ,$existing_mi_card_file);

                    if($file_mi_card_id != null){
                        Emp_Training::where('id',$id)->update(
                            array(  
                                    'id_mi_card_file' => $file_mi_card_id,  
                                    'updated_date'=> date('Y-m-d H:i:s'),
                                    'updated_by'  => 'System' )
                            );                        
                    }
                }

            }

            // return Redirect::to('/emp_training')->with('success', 'Data tersimpan.');
            return Redirect::action('Employee_ProfileController@edit', array('id' => $employee_profile_id))->with('success', 'Data tersimpan.');
            }
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            // return Redirect::to('emp_training')->withErrors($message);
            return Redirect::action('Employee_ProfileController@edit', array('id' => $employee_profile_id))->withErrors($message);
        }       

        // return Redirect::to('/emp_training');
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
            $emp_training = Emp_Training::find($id);
            if(!empty($emp_training)){
                $certificate_id = $emp_training->id_certificate_file;
                $mi_card_id = $emp_training->id_mi_card_file;

                $file = Doc_File::find($certificate_id);
                if(!empty($file)){
                    $file->destroy($certificate_id);
                }
                $file = Doc_File::find($mi_card_id);
                if(!empty($file)){
                    $file->destroy($mi_card_id);
                }
            }
            $emp_training->destroy($id);
            // return Redirect::to('emp_training');
            return Redirect::action('Employee_ProfileController@edit', array('id' => $employee_profile_id));
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            // return Redirect::to('/emp_training')->withErrors($message);
            return Redirect::action('Employee_ProfileController@edit', array('id' => $employee_profile_id))->withErrors($message);
        }
    }

    public function detail($id, $employee_profile_id){
        $data = Emp_Training::find($id);
        $list_training_type = Training_Type::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        return View::make('emp_training.detail')->with('data',$data)->with('list_status', $list_status)->with('list_training_type', $list_training_type)->with('employee_profile_id', $employee_profile_id);
    }

    protected function upload_new_document($file, $file_desc, $type){
            if(!$file->isValid()){
                $message = $validator->errors();
                $message->add('File', 'Dokumen '.$file_desc.' yang diupload tidak valid.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $name_file = $file->getClientOriginalName();
            $ext_file = $file->guessClientExtension();
            $loc_file = $file->getRealPath();
            $unique_name = $this->GUID().'.'.$ext_file;
            // $binary_content = file_get_contents($loc_file);
            // $encode_content = base64_encode($binary_content);
            // 
            if($type == 'cert'){
                $path_upload = $this->get_certificate_path();
            } else {
                $path_upload = $this->get_mi_card_path();
            }
            $file->move($path_upload, $unique_name);
            
            $doc_file  = new  Doc_File();
            $doc_file->name = $unique_name;
            $doc_file->original_filename = $name_file;
            $doc_file->file = null; //$encode_content;
            $doc_file->created_date = date('Y-m-d H:i:s');
            $doc_file->created_by = 'System';

            $doc_file->save();            
            $doc_file_id = null;
            $doc_file_id = DB::getPdo()->lastInsertId();
            return $doc_file_id;
    }

    public function download($id, $type){
        $doc_file = Doc_File::where('id', '=', $id)->firstOrFail();
        
        if(!empty($doc_file)){
            $file_name = $doc_file->name;
            $original_name = $doc_file->original_filename;
            if($type == 'cert'){
                $location = $this->get_certificate_path();
            } else {
                $location = $this->get_mi_card_path();
            }
            $binary_content =  file_get_contents($location.'\\'.$file_name);
            // $binary_content = base64_decode($doc_file->file);
            // $file = Storage::disk('local')->get($data->title);
            $ext_file = pathinfo($file_name, PATHINFO_EXTENSION);
            $ext_file = strtolower($ext_file);
            $content_type  = "";
            switch($ext_file){
                case "pdf":
                $content_type = "application/pdf";
                break;
                case "jpg":
                $content_type = "image/jpg";
                break;
                case "jpeg":
                $content_type = "image/jpg";
                break;
                case "xls":
                $content_type = "application/vnd.ms-excel";
                break;
                case "xlsx":
                $content_type = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
                break;
                case "doc":
                $content_type = "application/msword";
                break;
                case "docx":
                $content_type = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
                break;
                default:
                $content_type = "application/octet-stream";
                break;
            }
            $headers = array('Content-Type: '.$content_type);
            return (new Response($binary_content, 200))->header('Content-Type', $content_type);
        }
        return View::make('employee_profile.detail')->with('data',$data);
    }

    protected function upload_existing_document($file, $file_desc, $type, $existing_doc){
        if(!$file->isValid()){
            $message = $validator->errors();
            $message->add('File', 'Dokumen '.$file_desc.' yang diupload tidak valid.');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        } else {

            $name_file = $file->getClientOriginalName();
            $ext_file = $file->guessClientExtension();
            $loc_file = $file->getRealPath();
            if($type == 'cert'){
                $path_upload = $this->get_certificate_path();
            } else {
                $path_upload = $this->get_mi_card_path();
            }


            if(!empty($existing_doc) ){
                if(strtolower($ext_file) == $this->get_ext_file($existing_doc->name)){
                    $unique_name = $existing_doc->name;                    
                } else {
                    $unique_name = $this->GUID().'.'.$ext_file;
                    Doc_File::where('id',$existing_doc->id)->update(
                        array(  'name' => $unique_name,  
                                'original_filename'=> $name_file,
                                'updated_date'=> date('Y-m-d H:i:s'),
                                'updated_by'  => 'System' )
                        );                        
                }

                $file->move($path_upload, $unique_name);
            } else {
                $unique_name = $this->GUID().'.'.$ext_file;
                $file->move($path_upload, $unique_name);
                
                $doc_file  = new  Doc_File();
                $doc_file->name = $unique_name;
                $doc_file->original_filename = $name_file;
                $doc_file->file = null; //$encode_content;
                $doc_file->created_date = date('Y-m-d H:i:s');
                $doc_file->created_by = 'System';

                $doc_file->save();            
                $doc_file_id = DB::getPdo()->lastInsertId();
                return $doc_file_id;
            }
        }
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