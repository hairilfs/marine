<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Doc_File;
use App\Model\Document;
use App\Model\Directory_Document;
use App\Model\Doc_Type;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

use \View;

class Document_ExplorerController extends BaseController {

    public function __construct()
    {
        $this->middleware('auth');
    }

	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/
    public function index($dir_id = null )  { 
        if(empty($dir_id) || !is_numeric($dir_id)) $dir_id = null;
        $current_folder = $this->get_current_dir($dir_id)  ;
        $dir_id = $current_folder->id;
        $root = $this->get_root();
        $dir_path = $this->get_dir_path($dir_id);      
        $child_folder = $this->get_child_folder($dir_id);      
        $child_document = $this->get_child_document($dir_id);    
        $list_doc_type = Doc_Type::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        // $data = Document::orderBy('title')->get();       
        return View::make('document_explorer.index')->with('root_id',reset($root)->id)->with('dir_id',$current_folder->id)->with('dir_name',$current_folder->name)->with('directory', $dir_path)->with('child_folder', $child_folder)->with('child_document', $child_document)->with('list_doc_type',$list_doc_type)->with('list_status', $list_status);
    }

	public function browse_only($dir_id = null )	{ 
        if(empty($dir_id) || !is_numeric($dir_id)) $dir_id = null;
        $current_folder = $this->get_current_dir($dir_id)  ;
        $dir_id = $current_folder->id;
        $dir_path = $this->get_dir_path($dir_id);      
        $child_folder = $this->get_child_folder($dir_id);      
        $child_document = $this->get_child_document($dir_id);    
        $list_doc_type = Doc_Type::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
		// $data = Document::orderBy('title')->get();		
		return View::make('document_explorer.browse_only')->with('dir_id',$current_folder->id)->with('dir_name',$current_folder->name)->with('directory', $dir_path)->with('child_folder', $child_folder)->with('child_document', $child_document)->with('list_doc_type',$list_doc_type)->with('list_status', $list_status);
	}

    protected function get_root(){        
        $dir = DB::select('select * from directory_document where parent_id is null');
        return $dir;
    }

    protected function get_child_root(){        
        $dir = DB::select('select * from directory_document where parent_id is not null');
        return $dir;
    }

    protected function get_current_dir($dir_id)
    {
        $dir = null;
        if(empty($dir_id)) {
            $dir = $this->get_root();
        } else {
            $dir = DB::select('select * from directory_document where id =  ?', array($dir_id));
            if(!count($dir) > 0){
                $dir = $this->get_root();                
            }
        }
        return reset($dir);
    }

    protected function get_dir_path($dir_id){
        $all_dir  = [];        
        $result = array();
        if(empty($dir_id)) {
            $root_dir = $this->get_root();
            array_push($result, reset($root_dir));
        } else {
            $all_dir = DB::select('select * from directory_document');
            $parent_id = $dir_id;
            while(true){
                $dir = array_filter(array_values($all_dir), function ($v) use($parent_id) {                    
                    return $v->id == $parent_id;
                });
                if(!empty($dir)){
                    $dir = reset($dir);
                    $parent_id = $dir->parent_id;
                    array_unshift($result, $dir);
                    // array_splice($result ,1 ,0 , $dir);
                } else break;
            }
        }        

        return $result;
    }

    protected function get_regulation_doc_path(){
        $dir = 'C:\\';
        $data = DB::select('select * from settings where code = "directory.regulasi.document"');
        if(count($data) > 0) $dir = reset($data)->value;
        return $dir;
    }

    protected function get_child_folder($dir_id){
        $dir = DB::select('select * from directory_document where parent_id  = ?',array($dir_id));
        return $dir;
    }

    protected function get_child_document($dir_id){
        $doc = DB::select('select * from vw_document where id_dir  = ?',array($dir_id));
        return $doc;
    }

    protected function is_directory_exist($directories){
        $default_path = $this->get_regulation_doc_path();
        foreach ($directories as $dir) {
            $default_path = $default_path .'\\'.$dir->name;
            is_dir($default_path) || mkdir($default_path);
        }
        return $default_path .'\\';

    }


	public function view()
	{
		$data = Document::orderBy('id')->get();		        
        $list_doc_type = Doc_Type::orderBy('name')->lists('name', 'Id')->all();
		return View::make('document_explorer.view')->with('data',$data)->with('doc_type',$doc_type);
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
            $document = Document::find($id);
            $dir_id = $document->id_dir;
            $file_id = $document->id_file;
            $document->destroy($id);
            $file = Doc_File::find($file_id);
            if(!empty($file)){
                $target_file = $this->get_regulation_doc_path() .'\\'.$file->name;
                $file->destroy($file_id);
                //delete file in folder
                if (file_exists($target_file)) {
                    unlink($target_file);
                } 

            }

            // return Redirect::to('document_explorer');            
            return Redirect::route('document_explorer', array('dir_id' => $dir_id))->with('success', 'Dokumen dihapus.');
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('/document_explorer')->withErrors($message);
        }
    }

    public function detail($id){
        $data = Document::find($id);
        return View::make('document_explorer.detail')->with('data',$data);
    }

    public function download($id){
        // $data = Document::find($id);
        // $id = 0;
        $doc = Document::where('id_file', '=', $id)->firstOrFail();
        $doc_file = Doc_File::where('id', '=', $id)->firstOrFail();
        
        if(!empty($doc)){
            $file_name = $doc_file->name;
            $original_name = $doc_file->original_filename;
            $location = $this->get_regulation_doc_path();
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

            // return Response::download($binary_content, $doc->title, $headers);
            return (new Response($binary_content, 200))->header('Content-Type', $content_type);
        }
        return View::make('document_explorer.detail')->with('data',$data);
    }


    public function rename_folder()
    {
        try{

        $rules = array(
            'rename_folder' => 'required',
            'folder_id' => 'required'
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
            $data = Directory_Document::where('name', '=', Input::get('rename_folder'))->where('id', '<>', Input::get('folder_id'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Folder', 'Folder '.Input::get('rename_folder').' sudah ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $id  = Input::get('folder_id');
            Directory_Document::where('id',$id)->update(
                array(  'name' => Input::get('rename_folder'),
                        'description' => Input::get('rename_description'),
                        'updated_date'=> date('Y-m-d H:i:s'),
                        'updated_by'  => 'System' )
                );

            return Redirect::route('document_explorer', array('dir_id' => Input::get('folder_id')))->with('success', 'Data tersimpan.');
            // return Redirect::to('/document_explorer')->with('success', 'Data tersimpan.');
        }
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        return Redirect::to('document_explorer')->withErrors($message);
    }       

        return Redirect::to('/document_explorer');
    }

    public function create_folder()
    {
        try{

        $rules = array(
            'new_folder' => 'required',
            'dir_id' => 'required'
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
            $data = Directory_Document::where('name', '=', Input::get('new_folder'))->where('parent_id', '=', Input::get('dir_id'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Folder', 'Folder '.Input::get('new_folder').' sudah ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $directory_document = new Directory_Document();
            $directory_document->name = Input::get('new_folder');
            $directory_document->parent_id = Input::get('dir_id')>0 ? Input::get('dir_id'): null;
            $directory_document->is_public_folder = true;
            $directory_document->description = Input::get('description');
            $directory_document->created_date = date('Y-m-d H:i:s');
            $directory_document->created_by = 'System';

            $directory_document->save();
            $last_id = DB::getPdo()->lastInsertId();
            return Redirect::route('document_explorer', array('dir_id' => $last_id))->with('success', 'Data tersimpan.');
            // return Redirect::to('/document_explorer')->with('success', 'Data tersimpan.');
        }
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        return Redirect::to('document_explorer')->withErrors($message);
    }       

        return Redirect::to('/document_explorer');
    }

    public function remove_folder($dir_id)
    {
        try{


            $rules = array( );  

            $validator = Validator::make(Input::all(), $rules);
            //custom validation

            $directory = Directory_Document::find($dir_id);
            if(!empty($directory)){

                $list_child_doc = $this->get_child_document($dir_id);
                if(count($list_child_doc) > 0){
                    $message = $validator->errors();
                    $message->add('Folder', 'Masih terdapat file dokumen pada folder '.$directory->name.'. Mohon supaya dipindahkan terlebih dahulu');
                    return Redirect::back()
                        ->withErrors($validator) // send back all errors to the login form
                        ->withInput();

                } else {
                    $directory->destroy($dir_id);                    
                }
            }

            // return Redirect::to('document_explorer');            
            return Redirect::route('document_explorer', array('dir_id' => $dir_id))->with('success', 'Dokumen dihapus.');
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('/document_explorer')->withErrors($message);
        }
    }

    public function upload_document()
    {
        try{

        $rules = array(
            // 'title' => 'required',
            'dir_id' => 'required',
            // 'id_doctype' => 'required',
            'file' => 'required'
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

            $file = array('file' => Input::file('file'));

            //custom validation
            $data = Document::where('title', '=', Input::get('title'))->where('id_dir', '=', Input::get('dir_id'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('Title', 'Nama File'.Input::get('name').' pada folder '.Input::get('dir_name').' sudah ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            } 

            if(!Input::file('file')->isValid()){
                $message = $validator->errors();
                $message->add('File', 'Dokumen yang diupload tidak valid.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }


            $name_file = Input::file('file')->getClientOriginalName();
            $ext_file = Input::file('file')->guessClientExtension();
            $loc_file = Input::file('file')->getRealPath();
            $unique_name = $this->GUID().'.'.$ext_file;
            // $binary_content = file_get_contents($loc_file);
            // $encode_content = base64_encode($binary_content);

            // $dirs = $this->get_dir_path(Input::get('dir_id'));
            $path_upload = $this->get_regulation_doc_path();
            Input::file('file')->move($path_upload, $unique_name);

            $doc_file  = new  Doc_File();
            $doc_file->name = $unique_name;
            $doc_file->original_filename = $name_file;
            $doc_file->file = null; //$encode_content;
            $doc_file->created_date = date('Y-m-d H:i:s');
            $doc_file->created_by = 'System';

            $doc_file->save();            
            $doc_file_id = DB::getPdo()->lastInsertId();

            $document = new Document();
            $document->title = Input::file('file')->getClientOriginalName();
            $document->id_dir = Input::get('dir_id');
            // $document->id_doctype = Input::get('id_doctype')>0 ? Input::get('id_doctype'): null;
            $document->id_emp = Auth::user()->employee_profile != null? Auth::user()->employee_profile->id : null;
            // $document->id_version = 0; //Input::get('id_version');
            $document->id_file = $doc_file_id; 
            $document->description = Input::get('description');
            $document->status = Input::get('status'); //"Active"; 
            $document->date_upload = date('Y-m-d H:i:s');
            $document->created_date = date('Y-m-d H:i:s');
            $document->created_by = 'System';

            $document->save();

            // return Redirect::to('/document_explorer')->with('success', 'Data tersimpan.');
            return Redirect::route('document_explorer', array('dir_id' => Input::get('dir_id')))->with('success', 'Data tersimpan.');
        }
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        return Redirect::route('document_explorer', array('dir_id' => Input::get('dir_id')))->withErrors($message);
    }       

        return Redirect::to('/document_explorer');
    }

    protected function get_list_child_directory_id($dir_id){
        $result = array();
        $all_folders = $this->get_child_root();
        $folders = $this->get_child_folder($dir_id);
        foreach ($folders as $folder) {
            # code...

        }

    }

    public function get_tree_dir($target_id = null){

        try{
            if(empty($target_id) || is_null($target_id)) $target_id = 0;
            $root = $this->get_root();
            $root = reset($root);
            $folders = $this->get_child_root();
            return \Illuminate\Support\Facades\Response::view('document_explorer.tree', compact('root', 'folders', 'target_id'))->header('Content-Type', 'application/xml');
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('/document_explorer')->withErrors($message);
        }

    }


}