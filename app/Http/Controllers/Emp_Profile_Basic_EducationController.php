<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Emp_Education;
use App\Model\Emp_Basic_Education;
use App\Model\Doc_File;
use App\Model\University;
use App\Model\Faculty;
use App\Model\Major;
use App\Model\Education_Level;
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

class Emp_Profile_Basic_EducationController extends BaseController {

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
		$data = Emp_Basic_Education::orderBy('id')->get();		
		return View::make('emp_profile_basic_education.index')->with('data',$data);
	}

	public function view()
	{
		$data = Emp_Basic_Education::orderBy('id')->get();		
		return View::make('emp_profile_basic_education.view')->with('data',$data);
	}
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function add($employee_profile_id)
    {
        if(!$this->check_if_authorized($employee_profile_id)){
            $message = new MessageBag;
            $message->add('Error', 'Unauthorized access');
            return Redirect::action('Employee_ProfileController@edit_profile')->withErrors($message);
        }

        $list_level_basic_education = $this->get_list_level_basic_education();
        $list_status = $this->get_list_status();
        return View::make('emp_profile_basic_education.add')->with('list_status', $list_status)->with('list_level_basic_education', $list_level_basic_education)->with('employee_profile_id', $employee_profile_id);
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

        if(!$this->check_if_authorized($employee_profile_id)){
            $message = new MessageBag;
            $message->add('Error', 'Unauthorized access');
            return Redirect::action('Employee_ProfileController@edit_profile')->withErrors($message);
        }

		$rules = array(
            'employee_profile_id' => 'required',
            'level_education' => 'required',
            'school_name' => 'required',
            'graduate_year' => 'required'
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
            // $xxx =  Input::file('certificate_file');
            if(Input::file('certificate_file') != null ){
                $file_certificate_id = $this->upload_new_document(Input::file('certificate_file'), 'Sertifikasi', 'cert');
            }

            $emp_basic_education = new Emp_Basic_Education();
            $emp_basic_education->id_emp = $employee_profile_id;
            $emp_basic_education->level_education = Input::get('level_education');
            $emp_basic_education->school_name = Input::get('school_name');
            $emp_basic_education->graduate_year = Input::get('graduate_year');
            $emp_basic_education->location = Input::get('location');
            $emp_basic_education->head_master = Input::get('head_master');
            $emp_basic_education->id_certificate_file = $file_certificate_id;

            $emp_basic_education->description = Input::get('description');
            $emp_basic_education->created_date = date('Y-m-d H:i:s');
            $emp_basic_education->created_by = 'System';

            $emp_basic_education->save();

            //$emp_trainig_id = DB::getPdo()->lastInsertId();
        
            return Redirect::action('Employee_ProfileController@edit_profile')->with('success', 'Data tersimpan.');
        }
        
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        return Redirect::action('Employee_ProfileController@edit_profile')->withErrors($message);
    }       
        return Redirect::action('Employee_ProfileController@edit_profile');
	}

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id, $employee_profile_id)
    {
        if(!$this->check_if_authorized($employee_profile_id)){
            $message = new MessageBag;
            $message->add('Error', 'Unauthorized access');
            return Redirect::action('Employee_ProfileController@edit_profile')->withErrors($message);
        }

        $data = Emp_Basic_Education::find($id);
        $list_level_basic_education = $this->get_list_level_basic_education();
        $list_status = $this->get_list_status();
        if($data){            
            return View::make('emp_profile_basic_education.edit')->with('data', $data)->with('list_status', $list_status)->with('list_level_basic_education', $list_level_basic_education)->with('employee_profile_id', $employee_profile_id);
        } else {
            return Redirect::action('Employee_ProfileController@edit_profile');
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

        if(!$this->check_if_authorized($employee_profile_id)){
            $message = new MessageBag;
            $message->add('Error', 'Unauthorized access');
            return Redirect::action('Employee_ProfileController@edit_profile')->withErrors($message);
        }

        $rules = array(
            'employee_profile_id' => 'required',
            'level_education' => 'required',
            'school_name' => 'required',
            'graduate_year' => 'required'
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
            $graduate_year      = Input::get('graduate_year');  
            $level_education      = Input::get('level_education');  
            $school_name      = Input::get('school_name');  
            $location      = Input::get('location');  
            $head_master      = Input::get('head_master');  
            $description        = Input::get('description');  

            Emp_Basic_Education::where('id',$id)->update(
                array(  
                        'level_education'         => $level_education,  
                        'school_name'         => $school_name,  
                        'location'         => $location,  
                        'head_master'         => $head_master,  
                        'graduate_year'         => $graduate_year,  
                        'description'           => $description,  
                        'updated_date'=> date('Y-m-d H:i:s'),
                        'updated_by'  => 'System' )
                );

            //upload file document if any
            $emp_basic_education = Emp_Basic_Education::find($id);
            if(!empty($emp_basic_education)){
                $existing_certificate_file = Doc_File::find($emp_basic_education->id_certificate_file);

                $file_certificate_id  = null;
                if(Input::file('certificate_file') != null ){
                    $file_certificate_id = $this->upload_existing_document(Input::file('certificate_file'), 'Sertifikasi', 'cert', $existing_certificate_file);

                    if($file_certificate_id != null){
                        Emp_Basic_Education::where('id',$id)->update(
                            array(  'id_certificate_file' => $file_certificate_id,  
                                    'updated_date'=> date('Y-m-d H:i:s'),
                                    'updated_by'  => 'System' )
                            );                        
                    }
                }

            }

            return Redirect::action('Employee_ProfileController@edit_profile')->with('success', 'Data tersimpan.');
            }
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::action('Employee_ProfileController@edit_profile')->withErrors($message);
        }       

        return Redirect::action('Employee_ProfileController@edit_profile');
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
            if(!$this->check_if_authorized($employee_profile_id)){
                $message = new MessageBag;
                $message->add('Error', 'Unauthorized access');
                return Redirect::action('Employee_ProfileController@edit_profile')->withErrors($message);
            }

            $emp_basic_education = Emp_Basic_Education::find($id);
            if(!empty($emp_basic_education)){
                $certificate_id = $emp_basic_education->id_certificate_file;

                $file = Doc_File::find($certificate_id);
                if(!empty($file)){
                    $file->destroy($certificate_id);
                }
            }
            $emp_basic_education->destroy($id);
            return Redirect::action('Employee_ProfileController@edit_profile');
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::action('Employee_ProfileController@edit_profile')->withErrors($message);
        }
    }

    public function detail($id, $employee_profile_id){
        
        if(!$this->check_if_authorized($employee_profile_id)){
            $message = new MessageBag;
            $message->add('Error', 'Unauthorized access');
            return Redirect::action('Employee_ProfileController@edit_profile')->withErrors($message);
        }

        $data = Emp_Basic_Education::find($id);
        $list_level_basic_education = $this->get_list_level_basic_education();
        $list_status = $this->get_list_status();
        return View::make('emp_profile_basic_education.detail')->with('data',$data)->with('list_status', $list_status)->with('list_level_basic_education', $list_level_basic_education)->with('employee_profile_id', $employee_profile_id);
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
        $message = new MessageBag;
        $message->add('Error', 'File not found');
        return Redirect::action('Employee_ProfileController@edit_profile')->withErrors($message);
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