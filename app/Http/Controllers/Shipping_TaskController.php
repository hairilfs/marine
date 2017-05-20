<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Shipping_Task;
use App\Model\Shipping_Company;
use App\Model\Vessel;
use App\Model\Employee_Profile;
use App\Model\Harbour_Master;
use App\Model\Certificate_Task_Shipping;
use App\Model\Doc_File;
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

class Shipping_TaskController extends BaseController {

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
		$data = Shipping_Task::orderBy('id')->get();		
		return View::make('shipping_task.index')->with('data',$data);
	}

	public function view()
	{
		$data = Shipping_Task::orderBy('id')->get();		
		return View::make('shipping_task.view')->with('data',$data);
	}
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function add()
    {
        $list_shipping_company = Shipping_Company::orderBy('name')->lists('name', 'Id')->all();
        $list_harbour_master = Harbour_Master::orderBy('name')->lists('name', 'Id')->all();
        $list_vessel = Vessel::orderBy('vessel_name')->lists('vessel_name', 'Id')->all();
        $list_certificate = Certificate_Task_Shipping::orderBy('name')->lists('name', 'Id')->all();
        $data_employee = DB::select('select id, nip, name, sex,harbour_master_name, email01 from vw_employee_profile ');     
        $list_region = $this->get_list_region();
        $list_status = $this->get_list_status();
        return View::make('shipping_task.add')->with('list_status', $list_status)->with('list_shipping_company', $list_shipping_company)->with('list_harbour_master', $list_harbour_master)->with('list_vessel', $list_vessel)->with('list_certificate', $list_certificate)->with('list_region', $list_region)->with('data_employee', $data_employee);
    }
	/**
	* Store a newly created resource in storage.
	*
	* @return Response
	*/
	public function save()
	{
		try {

		$rules = array(
            'id_shipping_company' => 'required',
            'id_vessel' => 'required',
            'id_employee_profile' => 'required',
            'id_harbour_master' => 'required',
            'date_inspection' => 'required',
            'location' => 'required',
            'country' => 'required',
            'date_expired' => 'required',
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
                $file_certificate_id = $this->upload_new_document(Input::file('certificate_file'), 'Sertifikasi');
            }

            $shipping_task = new Shipping_Task();
            $shipping_task->id_shipping_company = Input::get('id_shipping_company')>0 ? Input::get('id_shipping_company'): null;
            $shipping_task->id_vessel = Input::get('id_vessel')>0 ? Input::get('id_vessel'): null;
            $shipping_task->id_harbour_master = Input::get('id_harbour_master')>0 ? Input::get('id_harbour_master'): null;
            $shipping_task->id_employee_profile = Input::get('id_employee_profile')>0 ? Input::get('id_employee_profile'): null;
            $shipping_task->id_certificate = Input::get('id_certificate')>0 ? Input::get('id_certificate'): null;

            $shipping_task->date_inspection = Input::get('date_inspection');
            $shipping_task->location = Input::get('location');
            $shipping_task->country = Input::get('country');
            $shipping_task->date_expired = Input::get('date_expired');
            $shipping_task->id_certificate_file = $file_certificate_id;

            $shipping_task->description = Input::get('description');
            $shipping_task->created_date = date('Y-m-d H:i:s');
            $shipping_task->created_by = 'System';

            $shipping_task->save();          

            return Redirect::action('Shipping_TaskController@index')->with('success', 'Data tersimpan.');
        }
        
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        return Redirect::action('Shipping_TaskController@add')->withErrors($message);
    }       
        return Redirect::action('Shipping_TaskController@index');
	}

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $data = Shipping_Task::find($id);
        $list_shipping_company = Shipping_Company::orderBy('name')->lists('name', 'Id')->all();
        $list_harbour_master = Harbour_Master::orderBy('name')->lists('name', 'Id')->all();
        $list_vessel = Vessel::orderBy('vessel_name')->lists('vessel_name', 'Id')->all();
        $list_certificate = Certificate_Task_Shipping::orderBy('name')->lists('name', 'Id')->all();
        $data_employee = DB::select('select id, nip, name, sex,harbour_master_name, email01 from vw_employee_profile ');     
        $list_region = $this->get_list_region();
        $list_status = $this->get_list_status();
        if($data){       
            $emp = Employee_Profile::find($data->id_employee_profile);
            $selected_employee = "";
            if(!empty($emp)){
                $selected_employee= $emp->nip." - ".$emp->name;
            }     
            return View::make('shipping_task.edit')->with('data', $data)->with('list_shipping_company', $list_shipping_company)->with('list_harbour_master', $list_harbour_master)->with('list_vessel', $list_vessel)->with('list_certificate', $list_certificate)->with('list_region', $list_region)->with('data_employee', $data_employee)->with('selected_employee', $selected_employee);
        } else {
            return Redirect::action('Shipping_TaskController@index');
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
            'id_shipping_company' => 'required',
            'id_vessel' => 'required',
            'id_employee_profile' => 'required',
            'id_harbour_master' => 'required',
            'date_inspection' => 'required',
            'location' => 'required',
            'country' => 'required',
            'date_expired' => 'required',
            );

        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();

            $input = input::all();

        } else {            


            $id                         = Input::get('id');
            $id_shipping_company      	= Input::get('id_shipping_company')>0 ? Input::get('id_shipping_company'): null;
            $id_vessel                  = Input::get('id_vessel')>0 ? Input::get('id_vessel'): null;
            $id_employee_profile        = Input::get('id_employee_profile')>0 ? Input::get('id_employee_profile'): null;
            $id_harbour_master          = Input::get('id_harbour_master')>0 ? Input::get('id_harbour_master'): null;
            $id_certificate             = Input::get('id_certificate')>0 ? Input::get('id_certificate'): null;
            $date_inspection            = empty(Input::get('date_inspection')) || Input::get('date_inspection') == ''? null: Input::get('date_inspection');     
            $date_expired               = empty(Input::get('date_expired')) || Input::get('date_expired') == ''? null: Input::get('date_expired');     
            $location                   = Input::get('location');  
            $country                    = Input::get('country');  
            $description                = Input::get('description');  

            Shipping_Task::where('id',$id)->update(
                array(  'id_shipping_company' => $id_shipping_company,
                        'id_vessel' => $id_vessel,  
                        'id_employee_profile'       => $id_employee_profile,  
                        'id_harbour_master' => $id_harbour_master,  
                        'id_certificate'    => $id_certificate,  
                        // 'id_certificate'    => null,  
                        'date_inspection'    => $date_inspection,  
                        'date_expired'    => $date_expired,  
                        'location'    => $location,  
                        'country'    => $country,  
                        'description'    => $description,  
                        'updated_date'=> date('Y-m-d H:i:s'),
                        'updated_by'  => 'System' )
                );

            //upload file document if any
            $shipping_task = Shipping_Task::find($id);
            if(!empty($shipping_task)){
                $existing_certificate_file = Doc_File::find($shipping_task->id_certificate_file);

                $file_certificate_id  = null;
                if(Input::file('certificate_file') != null ){
                    $file_certificate_id = $this->upload_existing_document(Input::file('certificate_file'), 'Sertifikasi',  $existing_certificate_file);

                    if($file_certificate_id != null){
                        Shipping_Task::where('id',$id)->update(
                            array(  'id_certificate_file' => $file_certificate_id,  
                                    'updated_date'=> date('Y-m-d H:i:s'),
                                    'updated_by'  => 'System' )
                            );                        
                    }
                }

            }

            return Redirect::action('Shipping_TaskController@index')->with('success', 'Data tersimpan.');
            }
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::action('Shipping_TaskController@index')->withErrors($message);
        }       

        return Redirect::action('Shipping_TaskController@index');
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
            $shipping_task = Shipping_Task::find($id);
            if(!empty($shipping_task)){
                $certificate_id = $shipping_task->id_certificate_file;

                $file = Doc_File::find($certificate_id);
                if(!empty($file)){
                    $file->destroy($certificate_id);
                }
            }
            $shipping_task->destroy($id);
            return Redirect::action('Shipping_TaskController@index');
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::action('Shipping_TaskController@index')->withErrors($message);
        }
    }

    public function detail($id){
        $data = Shipping_Task::find($id);
        $list_shipping_company = Shipping_Company::orderBy('name')->lists('name', 'Id')->all();
        $list_harbour_master = Harbour_Master::orderBy('name')->lists('name', 'Id')->all();
        $list_vessel = Vessel::orderBy('vessel_name')->lists('vessel_name', 'Id')->all();
        $list_certificate = Certificate_Task_Shipping::orderBy('name')->lists('name', 'Id')->all();
        $data_employee = DB::select('select id, nip, name, sex,harbour_master_name, email01 from vw_employee_profile ');     
        $list_region = $this->get_list_region();
        $list_status = $this->get_list_status();

        $emp = Employee_Profile::find($data->id_employee_profile);
        $selected_employee = "";
        if(!empty($emp)){
            $selected_employee= $emp->nip." - ".$emp->name;
        }
        return View::make('shipping_task.detail')->with('data',$data)->with('list_shipping_company', $list_shipping_company)->with('list_harbour_master', $list_harbour_master)->with('list_vessel', $list_vessel)->with('list_certificate', $list_certificate)->with('list_region', $list_region)->with('data_employee', $data_employee)->with('selected_employee', $selected_employee);
    }

    protected function upload_new_document($file, $file_desc){
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
            $path_upload = $this->get_certificate_path();
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

    public function download($id){
        $doc_file = Doc_File::where('id', '=', $id)->firstOrFail();
        
        if(!empty($doc_file)){
            $file_name = $doc_file->name;
            $original_name = $doc_file->original_filename;
            
            $location = $this->get_certificate_path();
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

    protected function upload_existing_document($file, $file_desc, $existing_doc){
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
            $path_upload = $this->get_certificate_path();

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
        $data = DB::select('select * from settings where code = "directory.shipping_task.certificate"');
        if(count($data) > 0) $dir = reset($data)->value;
        return $dir;
    }
}