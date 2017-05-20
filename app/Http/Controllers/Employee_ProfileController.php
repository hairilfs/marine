<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Employee_Profile;
use App\Model\Functional_Title;
use App\Model\Structural_Title;
use App\Model\Harbour_Master;
use App\Model\Harbour_Area;
use App\Model\Emp_Grade;
use App\Model\University;
use App\Model\Faculty;
use App\Model\Major;
use App\Model\Education_Level;
use App\Model\Emp_Basic_Education;
use App\Model\Emp_Addresses;
use App\Model\Emp_Experience;
use App\Model\Emp_Physical_Appearance;
use App\Model\Employee_Photo;
use App\Model\Doc_File;
use App\User;
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

use Html;
use Image;
use \View;

class Employee_ProfileController extends BaseController {

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function get_photo_path(){
        $dir = 'C:\\';
        $data = DB::select('select * from settings where code = "directory.employee.photo"');
        if(count($data) > 0) $dir = reset($data)->value;
        return $dir;
    }

    protected function list_emp_status_inactive(){
        $data = array('Pensiun' => 'Pensiun', 'Meninggal' => 'Meninggal', 'Resign' => 'Resign');
        return $data;
    }

    public function list_employee_by_harbour_id($id_harbour = null)
    {
        // $data = DB::select('select * from vw_employee_profile where id_harbour_master = ?', array($id_harbour));
        $sql = 'select ep.* , coalesce(el.name, "") education_level, coalesce(et.mi_card, "") mi_card, coalesce(tt.name, "") as training_type
                from employee_profile AS ep 
                left join (select id_emp, max(id_education_level) id_education_level from emp_education group by id_emp ) AS temp_ee on ep.id = temp_ee.id_emp
                left join (select id_employee_profile, max(mi_date) mi_date from emp_training group by id_employee_profile ) as  temp_et on ep.id = temp_et.id_employee_profile 
                left join emp_education ee on ee.id_emp = ep.id and ee.id_education_level = temp_ee.id_education_level 
                left join emp_training et on et.id_employee_profile = ep.id and et.mi_date = temp_et.mi_date 
                left join education_level el on ee.id_education_level = el.id
                left join training_type tt on et.id_training = tt.id
                where ep.id_harbour_master = ?';

        $data_ep = DB::select($sql, array($id_harbour));

        $sql = 'select * from harbour_master where id = ?';
        $data_hm = DB::select($sql, array($id_harbour));
        

        if(!empty( $data_hm)){
            $result = array('ep' => $data_ep, 'hm' => reset($data_hm));
            return  json_encode($result,JSON_NUMERIC_CHECK);
        }
        return json_encode(false,JSON_NUMERIC_CHECK);
    }

    public function get_emp_profile(){

        $temp = [];
        $data = DB::select('select * from vw_employee_profile ');
        if(!empty($data)){
            foreach ($data as $key => $value) {
                # code...
                array_push($temp , [$value->id, $value->nip, $value->name, $value->birth_date,$value->sex, $value->email01, $value->harbour_master_name,'','']);
            }
        }
        $result = array(
                        "draw"  => intval( Input::get('draw') ),
                        "data"  => $temp,
                    ); 
        return json_encode( $result , JSON_NUMERIC_CHECK);
    }

	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/
    public function index() { 

        // $data = Employee_Profile::orderBy('name')->get();        
        $data = DB::select('select * from vw_employee_profile ');      
        $list_functional_title = Functional_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_structural_title = Structural_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_harbour_master = Harbour_Master::orderBy('name')->lists('name', 'Id')->all();
        $list_emp_grade = Emp_Grade::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        $list_column = $this->get_list_column_mi();
        // $list_abjad = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        return View::make('employee_profile.index')->with('data',$data)->with('list_functional_title', $list_functional_title)->with('list_structural_title', $list_structural_title)->with('list_harbour_master', $list_harbour_master)->with('list_emp_grade', $list_emp_grade)->with('list_column', $list_column);
    }

    public function filter_column() { 

        // $data = Employee_Profile::orderBy('name')->get();        
        $data = DB::select('select * from vw_employee_profile ');      
        $list_functional_title = Functional_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_structural_title = Structural_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_harbour_master = Harbour_Master::orderBy('name')->lists('name', 'Id')->all();
        $list_emp_grade = Emp_Grade::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        // $list_abjad = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        return View::make('employee_profile.filter_column')->with('data',$data)->with('list_functional_title', $list_functional_title)->with('list_structural_title', $list_structural_title)->with('list_harbour_master', $list_harbour_master)->with('list_emp_grade', $list_emp_grade);
    }

    public function filter_by_training_type($id) { 
        if(empty($id) || $id == 0){
            $sql = "select * from vw_employee_profile";
            $data = DB::select($sql);
        } else {
            $sql = "select distinct vep.* from vw_employee_profile vep inner join emp_training et on vep.id = et.id_employee_profile where et.id_training = ? ";
            $data = DB::select($sql, array($id));
        }

        $list_functional_title = Functional_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_structural_title = Structural_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_harbour_master = Harbour_Master::orderBy('name')->lists('name', 'Id')->all();
        $list_emp_grade = Emp_Grade::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        $list_column = $this->get_list_column_mi();
        // $list_abjad = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        return View::make('employee_profile.index')->with('data',$data)->with('list_functional_title', $list_functional_title)->with('list_structural_title', $list_structural_title)->with('list_harbour_master', $list_harbour_master)->with('list_emp_grade', $list_emp_grade)->with('list_column', $list_column);
    }

    public function filter_by_graduate_date($year = null) { 
        $sql = "select * from vw_emp_profile_training";
        $filter = "";

        if( !is_null($year) && $year > 0){
            $filter .= " graduate_year = '".$year."' and ";
        }

        if($filter!=""){
            $sql .= " where ". substr($filter, 0, strlen($filter) - 4);
        }

        $data = DB::select($sql);



        // if(empty($year) || $year == 0){
        //     $sql = "select * from vw_employee_profile";
        //     $data = DB::select($sql);
        // } else {
        //     $sql = "select distinct vep.* from vw_employee_profile vep inner join emp_training et on vep.id = et.id_employee_profile where et.graduate_year = ? ";
        //     $data = DB::select($sql, array($year));
        // }

        $list_functional_title = Functional_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_structural_title = Structural_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_harbour_master = Harbour_Master::orderBy('name')->lists('name', 'Id')->all();
        $list_emp_grade = Emp_Grade::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        $list_column = $this->get_list_column_mi_training();
        
        return View::make('employee_profile.filter_by_graduate_date')->with('data',$data)->with('year',$year)->with('list_functional_title', $list_functional_title)->with('list_structural_title', $list_structural_title)->with('list_harbour_master', $list_harbour_master)->with('list_emp_grade', $list_emp_grade)->with('list_column', $list_column);
    }

    public function filter_by_mi_date($year = null) { 
        $sql = "select * from vw_emp_profile_training";
        $filter = "";

        if( !is_null($year) && $year > 0){
            $filter .= " year(mi_date) = '".$year."' and ";
        }

        if($filter!=""){
            $sql .= " where ". substr($filter, 0, strlen($filter) - 4);
        }

        $data = DB::select($sql);

        $list_functional_title = Functional_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_structural_title = Structural_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_harbour_master = Harbour_Master::orderBy('name')->lists('name', 'Id')->all();
        $list_emp_grade = Emp_Grade::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        $list_column = $this->get_list_column_mi_training();

        return View::make('employee_profile.filter_by_mi_date')->with('data',$data)->with('year',$year)->with('list_functional_title', $list_functional_title)->with('list_structural_title', $list_structural_title)->with('list_harbour_master', $list_harbour_master)->with('list_emp_grade', $list_emp_grade)->with('list_column', $list_column);
    }

    public function filter_by_harbour($harbour_master_id = null) { 
        if(empty($harbour_master_id) || $harbour_master_id == 0){
            $sql = "select * from vw_employee_profile";
            $data = DB::select($sql);
        } else {
            $sql = "select distinct vep.* from vw_employee_profile vep where vep.id_harbour_master = ? ";
            $data = DB::select($sql, array($harbour_master_id));
        }

        $list_functional_title = Functional_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_structural_title = Structural_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_harbour_master = Harbour_Master::orderBy('name')->lists('name', 'Id')->all();
        $list_harbour_area = Harbour_Area::orderBy('name')->lists('name', 'Id')->all();
        $list_emp_grade = Emp_Grade::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        $list_column = $this->get_list_column_mi();
        // $list_abjad = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        return View::make('employee_profile.filter_by_harbour')->with('harbour_master_id',$harbour_master_id)->with('data',$data)->with('list_functional_title', $list_functional_title)->with('list_structural_title', $list_structural_title)->with('list_harbour_master', $list_harbour_master)->with('list_harbour_area', $list_harbour_area)->with('list_emp_grade', $list_emp_grade)->with('list_column', $list_column);
    }

	public function filter_by_education($sex = null, $id_university = null, $id_faculty = null, $id_major = null, $id_education_level = null ) { 
        $sql = "select * from vw_emp_profile_education";
        $filter = "";

        if( !is_null($sex) && ( strtolower($sex) == "l" ||strtolower($sex) == "p" ) ){
            $filter .= " sex = '".$sex."' and ";
        }
        if( !is_null($id_university) && $id_university > 0){
            $filter .= " id_university = '".$id_university."' and ";
        }
        if( !is_null($id_faculty) && $id_faculty > 0){
            $filter .= " id_faculty = '".$id_faculty."' and ";
        }
        if( !is_null($id_major) && $id_major > 0){
            $filter .= " id_major = '".$id_major."' and ";
        }
        if( !is_null($id_education_level) && $id_education_level > 0){
            $filter .= " id_education_level = '".$id_education_level."' and ";
        }

        if($filter!=""){
            $sql .= " where ". substr($filter, 0, strlen($filter) - 4);
        }

        $data = DB::select($sql);

        $list_functional_title = Functional_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_structural_title = Structural_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_harbour_master = Harbour_Master::orderBy('name')->lists('name', 'Id')->all();
        $list_harbour_area = Harbour_Area::orderBy('name')->lists('name', 'Id')->all();
        $list_emp_grade = Emp_Grade::orderBy('name')->lists('name', 'Id')->all();

        $list_university = University::orderBy('name')->lists('name', 'Id')->all();
        $list_faculty = Faculty::orderBy('name')->lists('name', 'Id')->all();
        $list_major = Major::orderBy('name')->lists('name', 'Id')->all();
        $list_education_level = Education_level::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        $list_sex = $this->get_list_sex();
        $list_column = $this->get_list_column_mi_education();

		return View::make('employee_profile.filter_by_education')->with('data',$data)->with('sex', $sex)->with('id_university', $id_university)->with('id_faculty', $id_faculty)->with('id_major', $id_major)->with('id_education_level', $id_education_level)->with('list_functional_title', $list_functional_title)->with('list_structural_title', $list_structural_title)->with('list_harbour_master', $list_harbour_master)->with('list_harbour_area', $list_harbour_area)->with('list_emp_grade', $list_emp_grade)->with('list_university', $list_university)->with('list_faculty', $list_faculty)->with('list_major', $list_major)->with('list_education_level', $list_education_level)->with('list_sex', $list_sex)->with('list_column', $list_column);
	}

    public function list_only() { 
        $sql = "select * from vw_employee_profile";
        $data = DB::select($sql);

        $list_functional_title = Functional_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_structural_title = Structural_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_harbour_master = Harbour_Master::orderBy('name')->lists('name', 'Id')->all();
        $list_emp_grade = Emp_Grade::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        return View::make('employee_profile.list_only')->with('data',$data)->with('list_functional_title', $list_functional_title)->with('list_structural_title', $list_structural_title)->with('list_harbour_master', $list_harbour_master)->with('list_emp_grade', $list_emp_grade);
    }

	public function view()
	{
		// $data = Employee_Profile::orderBy('name')->get();		
        $data = DB::select('select * from vw_employee_profile ');      
		return View::make('employee_profile.view')->with('data',$data);
	}
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function add()
    {
        $list_functional_title = Functional_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_structural_title = Structural_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_harbour_master = Harbour_Master::orderBy('name')->lists('name', 'Id')->all();
        $list_emp_grade = Emp_Grade::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        $list_sex = $this->get_list_sex();
        $list_religion = $this->get_list_religion();
        return View::make('employee_profile.add')->with('list_functional_title', $list_functional_title)->with('list_structural_title', $list_structural_title)->with('list_harbour_master', $list_harbour_master)->with('list_emp_grade', $list_emp_grade)->with('list_status', $list_status)->with('list_sex', $list_sex)->with('list_religion', $list_religion);
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
            'nip' => 'required',
            'name' => 'required',
            // 'birth_date' => 'required',
            // 'birth_place' => 'required',
            'sex' => 'required',
            // 'address01' => 'required',
            'id_functional' => 'required',
            'id_structural' => 'required',
            'id_harbour_master' => 'required',
            'id_grade' => 'required',
            // 'file' => 'required'
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
            $data = Employee_Profile::where('nip', '=', Input::get('nip'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('NIP', 'NIP '.Input::get('nip').' sudah ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();

            }
            $employee_photo_id = null;

            if(Input::file('file') != null){
                $file = array('file' => Input::file('file'));
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
                // 
                $path_upload = $this->get_photo_path();
                Input::file('file')->move($path_upload, $unique_name);
                
                $employee_photo  = new  Employee_Photo();
                $employee_photo->name = $unique_name;
                $employee_photo->original_filename = $name_file;
                $employee_photo->file = null; //$encode_content;
                $employee_photo->created_date = date('Y-m-d H:i:s');
                $employee_photo->created_by = 'System';

                $employee_photo->save();            
                $employee_photo_id = DB::getPdo()->lastInsertId();                
            }



            $employee_profile = new Employee_Profile();
            $employee_profile->nip = Input::get('nip');
            $employee_profile->name = Input::get('name');
            $employee_profile->birth_place = Input::get('birth_place');
            $employee_profile->birth_date = Input::get('birth_date')!= null && Input::get('birth_date')!= ''  ? Input::get('birth_date'): null; 
            $employee_profile->religion = Input::get('religion');
            $employee_profile->sex = Input::get('sex');
            $employee_profile->npwp = Input::get('npwp');
            $employee_profile->marital_status = Input::get('marital_status');
            $employee_profile->hobby = Input::get('hobby');
            $employee_profile->id_photo = $employee_photo_id;
            $employee_profile->phone1 = Input::get('phone1');
            $employee_profile->phone2 = Input::get('phone2');
            $employee_profile->phone3 = Input::get('phone3');
            // $employee_profile->address01 = Input::get('address01');
            // $employee_profile->address02 = Input::get('address02');
            // $employee_profile->address03 = Input::get('address03');
            // $employee_profile->city = Input::get('city');
            // $employee_profile->zipcode = Input::get('zipcode');
            $employee_profile->email01 = Input::get('email01');
            $employee_profile->email02 = Input::get('email02');
            $employee_profile->struct_bidang = Input::get('struct_bidang');
            $employee_profile->struct_seksi = Input::get('struct_seksi');
            $employee_profile->id_functional = Input::get('id_functional');
            $employee_profile->id_structural = Input::get('id_structural');
            $employee_profile->id_harbour_master = Input::get('id_harbour_master');
            $employee_profile->id_grade = Input::get('id_grade');
            $employee_profile->description = Input::get('description');
            $employee_profile->status = Input::get('status');
            $employee_profile->created_date = date('Y-m-d H:i:s');
            $employee_profile->created_by = 'System';

            $employee_profile->save();

            return Redirect::to('/employee_profile')->with('success', 'Data tersimpan.');
        }
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        return Redirect::to('employee_profile')->withErrors($message);
    }       

		return Redirect::to('/employee_profile');
	}


    public function save_appearance()
    {
        try{

        $rules = array();

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
            $id = Input::get('emp_appearance_id');
            $data = Emp_Physical_Appearance::where('id', '=', $id)->first();
            if(empty($data)){

                $emp_appearance = new Emp_Physical_Appearance();
                $emp_appearance->height = Input::get('emp_appearance_height');
                $emp_appearance->weight = Input::get('emp_appearance_weight');
                $emp_appearance->id_emp = Input::get('emp_appearance_emp_id');
                $emp_appearance->hair = Input::get('emp_appearance_hair');
                $emp_appearance->facial_shape = Input::get('emp_appearance_faceshape');
                $emp_appearance->skin_color = Input::get('emp_appearance_skin_color');
                $emp_appearance->distinguishable = Input::get('emp_appearance_distinguishable');
                $emp_appearance->body_part_defect = Input::get('emp_appearance_body_part_defect');
                $emp_appearance->blood_type = Input::get('emp_appearance_blood_type');

                $emp_appearance->created_date = date('Y-m-d H:i:s');
                $emp_appearance->created_by = 'System';

                $emp_appearance->save();
            } else {

                $height = Input::get('emp_appearance_height');
                $weight = Input::get('emp_appearance_weight');
                $id_emp = Input::get('emp_appearance_emp_id');
                $hair = Input::get('emp_appearance_hair');
                $faceshape = Input::get('emp_appearance_faceshape');
                $skin_color = Input::get('emp_appearance_skin_color');
                $distinguishable = Input::get('emp_appearance_distinguishable');
                $body_part_defect = Input::get('emp_appearance_body_part_defect');

                Emp_Physical_Appearance::where('id',$id)->update(
                    array(  
                            // 'name' => $name,  
                            'height' => $height,  
                            'weight' => $weight,
                            'id_emp' => $id_emp,
                            'hair' => $hair,
                            'facial_shape' => $faceshape,
                            'skin_color' => $skin_color,
                            'distinguishable' => $distinguishable,
                            'body_part_defect' => $body_part_defect,
                            'updated_date' => date('Y-m-d H:i:s'),
                            'updated_by' => 'System' )
                    );
            }

            return Redirect::to('/employee_profile')->with('success', 'Data tersimpan.');
        }
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        return Redirect::to('employee_profile')->withErrors($message);
    }       

        return Redirect::to('/employee_profile');
    }

    public function save_profile_appearance()
    {
        try{

        $rules = array();

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
            $id = Input::get('emp_appearance_id');
            $data = Emp_Physical_Appearance::where('id', '=', $id)->first();
            if(empty($data)){

                $emp_appearance = new Emp_Physical_Appearance();
                $emp_appearance->height = Input::get('emp_appearance_height');
                $emp_appearance->weight = Input::get('emp_appearance_weight');
                $emp_appearance->id_emp = Input::get('emp_appearance_emp_id');
                $emp_appearance->hair = Input::get('emp_appearance_hair');
                $emp_appearance->facial_shape = Input::get('emp_appearance_faceshape');
                $emp_appearance->skin_color = Input::get('emp_appearance_skin_color');
                $emp_appearance->distinguishable = Input::get('emp_appearance_distinguishable');
                $emp_appearance->body_part_defect = Input::get('emp_appearance_body_part_defect');
                $emp_appearance->blood_type = Input::get('emp_appearance_blood_type');

                $emp_appearance->created_date = date('Y-m-d H:i:s');
                $emp_appearance->created_by = 'System';

                $emp_appearance->save();
            } else {

                $height = Input::get('emp_appearance_height');
                $weight = Input::get('emp_appearance_weight');
                $id_emp = Input::get('emp_appearance_emp_id');
                $hair = Input::get('emp_appearance_hair');
                $faceshape = Input::get('emp_appearance_faceshape');
                $skin_color = Input::get('emp_appearance_skin_color');
                $distinguishable = Input::get('emp_appearance_distinguishable');
                $body_part_defect = Input::get('emp_appearance_body_part_defect');
                $blood_type = Input::get('emp_appearance_blood_type');

                Emp_Physical_Appearance::where('id',$id)->update(
                    array(  
                            // 'name' => $name,  
                            'height' => $height,  
                            'weight' => $weight,
                            'id_emp' => $id_emp,
                            'hair' => $hair,
                            'facial_shape' => $faceshape,
                            'skin_color' => $skin_color,
                            'distinguishable' => $distinguishable,
                            'body_part_defect' => $body_part_defect,
                            'blood_type' => $blood_type,
                            'updated_date' => date('Y-m-d H:i:s'),
                            'updated_by' => 'System' )
                    );
            }

            return Redirect::to('/employee_profile/edit_profile')->with('success', 'Data tersimpan.');
        }
    } catch(QueryException $e){
        Log::error('Found exception. '.$e);
        $message = new MessageBag;
        $message->add('Error', $e->getMessage());
        return Redirect::to('/employee_profile/edit_profile')->withErrors($message);
    }       

        return Redirect::to('/employee_profile/edit_profile');
    }


    public function print_drh($id)
    {
        $data = Employee_Profile::find($id);
        $list_functional_title = Functional_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_structural_title = Structural_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_harbour_master = Harbour_Master::orderBy('name')->lists('name', 'Id')->all();
        $list_emp_grade = Emp_Grade::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        $list_sex = $this->get_list_sex();
        $list_religion = $this->get_list_religion();
        $list_status_inactive = $this->list_emp_status_inactive();
        $list_emp_training = DB::select('select * from vw_emp_training where id_employee_profile = ?', array($id));    
        $list_emp_basic_education = Emp_Basic_Education::where('id_emp', '=', $id)->get();
        $emp_address = Emp_Addresses::where('id_emp', '=', $id)->where('is_current', '1')->first();
        if(empty($emp_address)){
            $emp_address = new Emp_Addresses();
        }
        $list_emp_experience = Emp_Experience::where('id_emp', '=', $id)->get();
        $list_emp_education = DB::select('select * from vw_emp_education where id_emp = ? ', array($id));  

        $emp_appearance = Emp_Physical_Appearance::where('id_emp', '=', $id)->first();
        if(empty($emp_appearance)){
            $emp_appearance = new Emp_Physical_Appearance();
        }
        
        if($data){            
            return View::make('employee_profile.print')->with('data', $data)->with('list_functional_title', $list_functional_title)->with('list_structural_title', $list_structural_title)->with('list_harbour_master', $list_harbour_master)->with('list_emp_grade', $list_emp_grade)->with('list_status', $list_status)->with('list_sex', $list_sex)->with('list_religion', $list_religion)->with('list_emp_training', $list_emp_training)->with('list_emp_education', $list_emp_education)->with('list_emp_basic_education', $list_emp_basic_education)->with('list_emp_experience', $list_emp_experience)->with('emp_address', $emp_address)->with('list_status_inactive', $list_status_inactive)->with('emp_appearance', $emp_appearance);
        } else {
            return Redirect::to('/employee_profile');
            // return Redirect::action('EmpGradeController@index');
        }
    }

    public function print_profile_drh()
    {
        $id = 0;
        $data = null;

        $rules = array();
        $validator = Validator::make(Input::all(), $rules);
        $message = $validator->errors();
        
        $user = User::find(Auth::user()->id);
        if( !$user->exists){
            $message->add('User', 'User not found. Please contact administrator');
            return Redirect::to('/')->withErrors($validator);
        } else {
            $id = $user->id_employee;
            $data = Employee_Profile::find($id);
            if(empty($data)){                
                $message->add('Profile', 'Profile not found. Please make sure your profile already mapped into your user account table');
                return Redirect::to('/')->withErrors($validator);

            }
        }
        
        $data = Employee_Profile::find($id);
        $list_functional_title = Functional_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_structural_title = Structural_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_harbour_master = Harbour_Master::orderBy('name')->lists('name', 'Id')->all();
        $list_emp_grade = Emp_Grade::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        $list_sex = $this->get_list_sex();
        $list_religion = $this->get_list_religion();
        $list_status_inactive = $this->list_emp_status_inactive();
        $list_emp_training = DB::select('select * from vw_emp_training where id_employee_profile = ?', array($id));    
        $list_emp_basic_education = Emp_Basic_Education::where('id_emp', '=', $id)->get();
        $emp_address = Emp_Addresses::where('id_emp', '=', $id)->where('is_current', '1')->first();
        if(empty($emp_address)){
            $emp_address = new Emp_Addresses();
        }
        $list_emp_experience = Emp_Experience::where('id_emp', '=', $id)->get();
        $list_emp_education = DB::select('select * from vw_emp_education where id_emp = ? ', array($id));  

        $emp_appearance = Emp_Physical_Appearance::where('id_emp', '=', $id)->first();
        if(empty($emp_appearance)){
            $emp_appearance = new Emp_Physical_Appearance();
        }
        
        if($data){            
            return View::make('employee_profile.print')->with('data', $data)->with('list_functional_title', $list_functional_title)->with('list_structural_title', $list_structural_title)->with('list_harbour_master', $list_harbour_master)->with('list_emp_grade', $list_emp_grade)->with('list_status', $list_status)->with('list_sex', $list_sex)->with('list_religion', $list_religion)->with('list_emp_training', $list_emp_training)->with('list_emp_education', $list_emp_education)->with('list_emp_basic_education', $list_emp_basic_education)->with('list_emp_experience', $list_emp_experience)->with('emp_address', $emp_address)->with('list_status_inactive', $list_status_inactive)->with('emp_appearance', $emp_appearance);
        } else {
            return Redirect::to('/');
        }
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $data = Employee_Profile::find($id);
        $list_functional_title = Functional_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_structural_title = Structural_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_harbour_master = Harbour_Master::orderBy('name')->lists('name', 'Id')->all();
        $list_emp_grade = Emp_Grade::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        $list_sex = $this->get_list_sex();
        $list_religion = $this->get_list_religion();
        $list_status_inactive = $this->list_emp_status_inactive();
        $list_emp_training = DB::select('select * from vw_emp_training where id_employee_profile = ?', array($id));    
        $list_emp_basic_education = Emp_Basic_Education::where('id_emp', '=', $id)->get();
        $list_emp_address = Emp_Addresses::where('id_emp', '=', $id)->get();
        $list_emp_experience = Emp_Experience::where('id_emp', '=', $id)->get();
        $list_emp_education = DB::select('select * from vw_emp_education where id_emp = ? ', array($id));  

        $emp_appearance = Emp_Physical_Appearance::where('id_emp', '=', $id)->first();
        if(empty($emp_appearance)){
            $emp_appearance = new Emp_Physical_Appearance();
        }
        
        if($data){            
            return View::make('employee_profile.edit')->with('data', $data)->with('list_functional_title', $list_functional_title)->with('list_structural_title', $list_structural_title)->with('list_harbour_master', $list_harbour_master)->with('list_emp_grade', $list_emp_grade)->with('list_status', $list_status)->with('list_sex', $list_sex)->with('list_religion', $list_religion)->with('list_emp_training', $list_emp_training)->with('list_emp_education', $list_emp_education)->with('list_emp_basic_education', $list_emp_basic_education)->with('list_emp_experience', $list_emp_experience)->with('list_emp_address', $list_emp_address)->with('list_status_inactive', $list_status_inactive)->with('emp_appearance', $emp_appearance);
        } else {
            return Redirect::to('/employee_profile');
            // return Redirect::action('EmpGradeController@index');
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
            // 'nip' => 'required',
            'name' => 'required',
            // 'birth_date' => 'required',
            // 'birth_place' => 'required',
            'sex' => 'required',
            // 'address01' => 'required',
            'id_functional' => 'required',
            'id_structural' => 'required',
            'id_harbour_master' => 'required',
            'id_grade' => 'required'
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
            $data = Employee_Profile::where('id', '!=', Input::get('id'))->where('nip', '=', Input::get('nip'))->first();
            if(!empty($data)){
                $message = $validator->errors();
                $message->add('NIP', 'NIP '.Input::get('nip').' sudah  ada.');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }

            $id = Input::get('id');
            // $nip = Input::get('nip');
            $name = Input::get('name');
            $birth_place = Input::get('birth_place');
            $birth_date = Input::get('birth_date')!= null && Input::get('birth_date')!= ''  ? Input::get('birth_date'): null; 
            $religion = Input::get('religion');
            $sex = Input::get('sex');
            $npwp = Input::get('npwp');
            $marital_status = Input::get('marital_status');
            $hobby = Input::get('hobby');
            // $id_photo = Input::get('id_photo');
            $phone1 = Input::get('phone1');
            $phone2 = Input::get('phone2');
            $phone3 = Input::get('phone3');
            // $address01 = Input::get('address01');
            // $address02 = Input::get('address02');
            // $address03 = Input::get('address03');
            // $city = Input::get('city');
            // $zipcode = Input::get('zipcode');
            $email01 = Input::get('email01');
            $email02 = Input::get('email02');
            $struct_bidang = Input::get('struct_bidang');
            $struct_seksi = Input::get('struct_seksi');
            $id_functional = Input::get('id_functional');
            $id_structural = Input::get('id_structural');
            $id_harbour_master = Input::get('id_harbour_master');
            $id_grade = Input::get('id_grade');
            $description = Input::get('description');
            $status = Input::get('status');
            $status_desc = $status == "Not Active"? Input::get('status_desc'): null;

            Employee_Profile::where('id',$id)->update(
                array(  'name' => $name,  
                        'birth_place' => $birth_place,  
                        'birth_date' => $birth_date,
                        'religion' => $religion,
                        'sex' => $sex,
                        'npwp' => $npwp,
                        'marital_status' => $marital_status,
                        'hobby' => $hobby,
                        // 'id_photo' => $id_photo,
                        'phone1' => $phone1,
                        'phone2' => $phone2,
                        'phone3' => $phone3,
                        // 'address01' => $address01,
                        // 'address02' => $address02,
                        // 'address03' => $address03,
                        // 'city' => $city,
                        // 'zipcode' => $zipcode,
                        'email01' => $email01,
                        'email02' => $email02,
                        'struct_bidang' => $struct_bidang,
                        'struct_seksi' => $struct_seksi,
                        'id_functional' => $id_functional,
                        'id_structural' => $id_structural,
                        'id_harbour_master' => $id_harbour_master,
                        'id_grade' => $id_grade,
                        'description' => $description,  
                        'status'    => $status,
                        'status_desc'  => $status_desc,
                        'updated_date' => date('Y-m-d H:i:s'),
                        'updated_by' => 'System' )
                );


            //check upload new photo or not
            if(Input::file('file') != null ){

                $file = array('file' => Input::file('file'));
                if(!Input::file('file')->isValid()){
                    $message = $validator->errors();
                    $message->add('File', 'File foto yang diupload tidak valid.');
                    return Redirect::back()
                        ->withErrors($validator) // send back all errors to the login form
                        ->withInput();
                } else {

                    $name_file = Input::file('file')->getClientOriginalName();
                    $ext_file = Input::file('file')->guessClientExtension();
                    $loc_file = Input::file('file')->getRealPath();
                    $path_upload = $this->get_photo_path();

                    $data = Employee_Profile::find(Input::get('id'));
                    if(!empty($data)){
                        $id_photo = $data->id_photo != null  && !empty($data->id_photo)? $data->id_photo: 0;
                        $photo = Employee_Photo::find($id_photo);
                        if(!empty($photo)){
                            $unique_name = $photo->name;
                            // $binary_content = file_get_contents($loc_file);
                            // $encode_content = base64_encode($binary_content);

                            Input::file('file')->move($path_upload, $unique_name);
                        } else {
                            $unique_name = $this->GUID().'.'.$ext_file;
                            // $binary_content = file_get_contents($loc_file);
                            // $encode_content = base64_encode($binary_content);

                            Input::file('file')->move($path_upload, $unique_name);
                            
                            $employee_photo  = new  Employee_Photo();
                            $employee_photo->name = $unique_name;
                            $employee_photo->original_filename = $name_file;
                            $employee_photo->file = null; //$encode_content;
                            $employee_photo->created_date = date('Y-m-d H:i:s');
                            $employee_photo->created_by = 'System';

                            $employee_photo->save();            
                            $employee_photo_id = DB::getPdo()->lastInsertId();

                            //update employee profile
                            Employee_Profile::where('id',$id)->update(
                                array(  
                                        'id_photo' => $employee_photo_id,
                                        'updated_date' => date('Y-m-d H:i:s'),
                                        'updated_by' => 'System' )
                                );
                        }                    
                    }

                }

            }

            return Redirect::to('/employee_profile')->with('success', 'Data tersimpan.');
        }
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('employee_profile')->withErrors($message);
        }       

        return Redirect::to('/employee_profile');
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
     
            $employee_profile = Employee_Profile::find($id);
            if(!empty($employee_profile)){
                $photo_id = $employee_profile->id_photo;
                if($photo_id != null){
                    $photo = Employee_Photo::find($photo_id);
                    $photo->destroy($photo_id);                    
                }
            }
            $employee_profile->destroy($id);
            return Redirect::to('employee_profile');
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('/employee_profile')->withErrors($message);
        }
    }

    public function detail($id){
        $data = Employee_Profile::find($id);
        $list_functional_title = Functional_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_structural_title = Structural_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_harbour_master = Harbour_Master::orderBy('name')->lists('name', 'Id')->all();
        $list_emp_grade = Emp_Grade::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        $list_sex = $this->get_list_sex();
        $list_religion = $this->get_list_religion();
        $list_status_inactive = $this->list_emp_status_inactive();
        $list_emp_training = DB::select('select * from vw_emp_training where id_employee_profile = ?', array($id));    
        $list_emp_education = DB::select('select * from vw_emp_education where id_emp = ? ', array($id));    
        $list_emp_basic_education = Emp_Basic_Education::where('id_emp', '=', $id)->get();
        $list_emp_address = Emp_Addresses::where('id_emp', '=', $id)->get();
        $list_emp_experience = Emp_Experience::where('id_emp', '=', $id)->get();
        $list_emp_education = DB::select('select * from vw_emp_education where id_emp = ? ', array($id));  

        $emp_appearance = Emp_Physical_Appearance::where('id_emp', '=', $id)->first();
        if(empty($emp_appearance)){
            $emp_appearance = new Emp_Physical_Appearance();
        }
        
        return View::make('employee_profile.detail')->with('data',$data)->with('list_status', $list_status)->with('list_emp_training', $list_emp_training)->with('list_emp_education', $list_emp_education)->with('list_functional_title', $list_functional_title)->with('list_structural_title', $list_structural_title)->with('list_harbour_master', $list_harbour_master)->with('list_emp_grade', $list_emp_grade)->with('list_sex', $list_sex)->with('list_religion', $list_religion)->with('list_emp_basic_education', $list_emp_basic_education)->with('list_emp_experience', $list_emp_experience)->with('list_emp_address', $list_emp_address)->with('list_status_inactive', $list_status_inactive)->with('emp_appearance', $emp_appearance);;
    }


    public function get_photo($id = null){
        // $photo = Employee_Photo::where('id', '=', $id)->firstOrFail();
        $photo = Employee_Photo::find($id);
        
        if(!empty($photo)){
            $file_name = $photo->name;
            $original_name = $photo->original_filename;
            $location = $this->get_photo_path();
            $binary_content =  file_get_contents($location.'\\'.$file_name);
            // $binary_content = base64_decode($photo->file);
            // $file = Storage::disk('local')->get($data->title);
        } else {            
            $file_name = 'no_photo.gif';
            $location = base_path('content/img/').$file_name;
            $binary_content =  file_get_contents($location);
        }
            $ext_file = pathinfo($file_name, PATHINFO_EXTENSION);
            $ext_file = strtolower($ext_file);
            $content_type  = "";
            switch($ext_file){
                case "gif":
                $content_type = "image/gif";
                case "jpg":
                $content_type = "image/jpg";
                break;
                case "jpeg":
                $content_type = "image/jpg";
                break;
                case "png":
                $content_type = "image/png";
                break;
                default:
                $content_type = "application/octet-stream";
                break;
            }
            $headers = array('Content-Type: '.$content_type);

            // return Response::download($binary_content, $doc->title, $headers);
            return (new Response($binary_content, 200))->header('Content-Type', $content_type);
    }

    public function get_icon_photo($id = null){
        // $photo = Employee_Photo::where('id', '=', $id)->firstOrFail();
        $photo = Employee_Photo::find($id);
        
        if(!empty($photo)){
            $file_name = $photo->name;
            $original_name = $photo->original_filename;
            $location = $this->get_photo_path();
            $binary_content = Image::cache(function($image) use($location, $file_name) {
               return $image->make($location.'\\'.$file_name)->resize(40,40);
            });
            // $binary_content =  file_get_contents($location.'\\'.$file_name);
            // $binary_content = $this->smart_resize_image($location.'\\'.$file_name, null, 40,40, false, null, false);
            // $binary_content = base64_decode($photo->file);
            // $file = Storage::disk('local')->get($data->title);
        } else {            
            $file_name = 'no_photo.gif';
            $location = base_path('content/img/').$file_name;
            // $binary_content =  file_get_contents($location);
            // $binary_content = $this->smart_resize_image($location, null, 40,40, false, null, false);
            $binary_content = Image::cache(function($image) use($location) {
               return $image->make($location)->resize(40,40);
            });
        }
            $ext_file = pathinfo($file_name, PATHINFO_EXTENSION);
            $ext_file = strtolower($ext_file);
            $content_type  = "";
            switch($ext_file){
                case "gif":
                $content_type = "image/gif";
                case "jpg":
                $content_type = "image/jpg";
                break;
                case "jpeg":
                $content_type = "image/jpg";
                break;
                case "png":
                $content_type = "image/png";
                break;
                default:
                $content_type = "application/octet-stream";
                break;
            }
            $headers = array('Content-Type: '.$content_type);

            // return Response::download($binary_content, $doc->title, $headers);
            return (new Response($binary_content, 200))->header('Content-Type', $content_type);
    }

    public function edit_profile(){
        $id = 0;
        $data = null;

        $rules = array();
        $validator = Validator::make(Input::all(), $rules);
        $message = $validator->errors();
        
        $user = User::find(Auth::user()->id);
        if( !$user->exists){
            $message->add('User', 'User not found. Please contact administrator');
            return Redirect::to('/')->withErrors($validator);
        } else {
            $id = $user->id_employee;
            $data = Employee_Profile::find($id);
            if(empty($data)){                
                $message->add('Profile', 'Profile not found. Please make sure your profile already mapped into your user account table');
                return Redirect::to('/')->withErrors($validator);

            }
        }

        // $data = Employee_Profile::find($id);
        $list_functional_title = Functional_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_structural_title = Structural_Title::orderBy('name')->lists('name', 'Id')->all();
        $list_harbour_master = Harbour_Master::orderBy('name')->lists('name', 'Id')->all();
        $list_emp_grade = Emp_Grade::orderBy('name')->lists('name', 'Id')->all();
        $list_status = $this->get_list_status();
        $list_sex = $this->get_list_sex();
        $list_religion = $this->get_list_religion();
        $list_emp_training = DB::select('select * from vw_emp_training where id_employee_profile = ?', array($id));    
        $list_emp_basic_education = Emp_Basic_Education::where('id_emp', '=', $id)->get();
        $list_emp_address = Emp_Addresses::where('id_emp', '=', $id)->get();
        $list_emp_experience = Emp_Experience::where('id_emp', '=', $id)->get();
        $list_emp_education = DB::select('select * from vw_emp_education where id_emp = ? ', array($id));  
        $emp_appearance = Emp_Physical_Appearance::where('id_emp', '=', $id)->first();
        if($emp_appearance == null){
            $emp_appearance = new Emp_Physical_Appearance();
        }
        return View::make('employee_profile.edit_profile')->with('data',$data)->with('list_status', $list_status)->with('list_emp_training', $list_emp_training)->with('list_emp_education', $list_emp_education)->with('list_functional_title', $list_functional_title)->with('list_structural_title', $list_structural_title)->with('list_harbour_master', $list_harbour_master)->with('list_emp_grade', $list_emp_grade)->with('list_sex', $list_sex)->with('list_religion', $list_religion)->with('list_emp_education', $list_emp_education)->with('list_emp_basic_education', $list_emp_basic_education)->with('list_emp_experience', $list_emp_experience)->with('list_emp_address', $list_emp_address)->with('emp_appearance', $emp_appearance);
    }

    public  function save_profile()
    {
        try{

        $rules = array(
            // 'nip' => 'required',
            'name' => 'required',
            'birth_date' => 'required',
            'birth_place' => 'required',
            'sex' => 'required',
            // 'address01' => 'required',
            // 'id_functional' => 'required',
            // 'id_structural' => 'required',
            // 'id_harbour_master' => 'required',
            // 'id_grade' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();

            $input = input::all();

        } else {            

            // //custom validation
            // $data = Employee_Profile::where('id', '!=', Input::get('id'))->where('nip', '=', Input::get('nip'))->first();
            // if(!empty($data)){
            //     $message = $validator->errors();
            //     $message->add('NIP', 'NIP '.Input::get('nip').' sudah  ada.');
            //     return Redirect::back()
            //         ->withErrors($validator) // send back all errors to the login form
            //         ->withInput();
            // }

            $id = Input::get('id');
            // $nip = Input::get('nip');
            // $name = Input::get('name');
            $birth_place = Input::get('birth_place');
            $birth_date = Input::get('birth_date')!= null && Input::get('birth_date')!= ''  ? Input::get('birth_date'): null; 
            $religion = Input::get('religion');
            $sex = Input::get('sex');
            $npwp = Input::get('npwp');
            $marital_status = Input::get('marital_status');
            $hobby = Input::get('hobby');
            // $id_photo = Input::get('id_photo');
            $phone1 = Input::get('phone1');
            $phone2 = Input::get('phone2');
            $phone3 = Input::get('phone3');
            // $address01 = Input::get('address01');
            // $address02 = Input::get('address02');
            // $address03 = Input::get('address03');
            // $city = Input::get('city');
            // $zipcode = Input::get('zipcode');
            $email01 = Input::get('email01');
            $email02 = Input::get('email02');
            // $struct_bidang = Input::get('struct_bidang');
            // $struct_seksi = Input::get('struct_seksi');
            // $id_functional = Input::get('id_functional');
            // $id_structural = Input::get('id_structural');
            // $id_harbour_master = Input::get('id_harbour_master');
            // $id_grade = Input::get('id_grade');
            $description = Input::get('description');
            // $status = Input::get('status');

            Employee_Profile::where('id',$id)->update(
                array(  
                        // 'name' => $name,  
                        'birth_place' => $birth_place,  
                        'birth_date' => $birth_date,
                        'religion' => $religion,
                        'sex' => $sex,
                        'npwp' => $npwp,
                        'marital_status' => $marital_status,
                        'hobby' => $hobby,
                        // 'id_photo' => $id_photo,
                        'phone1' => $phone1,
                        'phone2' => $phone2,
                        'phone3' => $phone3,
                        // 'address01' => $address01,
                        // 'address02' => $address02,
                        // 'address03' => $address03,
                        // 'city' => $city,
                        // 'zipcode' => $zipcode,
                        'email01' => $email01,
                        'email02' => $email02,
                        // 'struct_bidang' => $struct_bidang,
                        // 'struct_seksi' => $struct_seksi,
                        // 'id_functional' => $id_functional,
                        // 'id_structural' => $id_structural,
                        // 'id_harbour_master' => $id_harbour_master,
                        // 'id_grade' => $id_grade,
                        'description' => $description,  
                        // 'status'    => $status,
                        'updated_date' => date('Y-m-d H:i:s'),
                        'updated_by' => 'System' )
                );


            //check upload new photo or not
            if(Input::file('file') != null ){

                $file = array('file' => Input::file('file'));
                if(!Input::file('file')->isValid()){
                    $message = $validator->errors();
                    $message->add('File', 'File foto yang diupload tidak valid.');
                    return Redirect::back()
                        ->withErrors($validator) // send back all errors to the login form
                        ->withInput();
                } else {

                    $name_file = Input::file('file')->getClientOriginalName();
                    $ext_file = Input::file('file')->guessClientExtension();
                    $loc_file = Input::file('file')->getRealPath();
                    $path_upload = $this->get_photo_path();

                    $data = Employee_Profile::find(Input::get('id'));
                    if(!empty($data)){
                        $id_photo = $data->id_photo != null  && !empty($data->id_photo)? $data->id_photo: 0;
                        $photo = Employee_Photo::find($id_photo);
                        if(!empty($photo)){
                            $unique_name = $photo->name;
                            // $binary_content = file_get_contents($loc_file);
                            // $encode_content = base64_encode($binary_content);

                            Input::file('file')->move($path_upload, $unique_name);
                        } else {
                            $unique_name = $this->GUID().'.'.$ext_file;
                            // $binary_content = file_get_contents($loc_file);
                            // $encode_content = base64_encode($binary_content);

                            Input::file('file')->move($path_upload, $unique_name);
                            
                            $employee_photo  = new  Employee_Photo();
                            $employee_photo->name = $unique_name;
                            $employee_photo->original_filename = $name_file;
                            $employee_photo->file = null; //$encode_content;
                            $employee_photo->created_date = date('Y-m-d H:i:s');
                            $employee_photo->created_by = 'System';

                            $employee_photo->save();            
                            $employee_photo_id = DB::getPdo()->lastInsertId();

                            //update employee profile
                            Employee_Profile::where('id',$id)->update(
                                array(  
                                        'id_photo' => $employee_photo_id,
                                        'updated_date' => date('Y-m-d H:i:s'),
                                        'updated_by' => 'System' )
                                );
                        }                    
                    }

                }

            }

            return Redirect::to('/employee_profile/edit_profile')->with('success', 'Data tersimpan.');
        }
        } catch(QueryException $e){
            Log::error('Found exception. '.$e);
            $message = new MessageBag;
            $message->add('Error', $e->getMessage());
            return Redirect::to('employee_profile/edit_profile')->withErrors($message);
        }       

        return Redirect::to('/employee_profile/edit_profile');
    }


}