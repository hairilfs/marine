<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\User;
use App\Model\Role;
use App\Model\Status_Notification;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Illuminate\View;

class BaseController extends Controller {

	protected function check_if_authorized($employee_profile_id){
		if(!empty($employee_profile_id)){
			if(Auth::user()->employee_profile->id == $employee_profile_id){
				return true;
			}
		}
		return false;
	}

	protected function list_notification() {
		$data = Status_Notification::where('id_user', Auth::user()->id_role)->get();
		return \View::make('notification.index')->with('data',$data);
	}

	protected function new_notification(){
		return \View::make('notification.add');
	}

	// protected function insert_notification($code, $messsage, $url_action, $role_id, $user_id){
	protected function insert_notification(Request $req){
		$role_id = Auth::user()->id_role;
		$data  = [];
		if($role_id != null){
			$list_user = Role::where('id', '=', $role_id)->get();
			foreach ($list_user as $user) {
			// dd($user);
				# code...
				$d = array(	'code' 		=> $req->code,
							'id_user'	=> $user->id,
							'message'	=> $req->message,
							'url_action'=> $req->url_action,
			                'created_date' 	=> date('Y-m-d H:i:s'),
			                'created_by' 	=> 'System'
						);
				// array_push($data, $d);
				$data[] = $d;
			}
		} else {
			$data = array(	'code' 		=> $req->code,
							'id_user'	=> $user->id,
							'message'	=> $req->message,
							'url_action'=> $req->url_action,
			                'created_date' 	=> date('Y-m-d H:i:s'),
			                'created_by' 	=> 'System'
					);
		}

		$return = Status_Notification::insert($data);
		
		if ($return) {
			return \View::make('notification.index')->with('message', 'Notification sent');
		}

		return redirect()->route('notification/new');


	}

	protected function update_status_notification($id){
        $data = Status_Notification::find($id);
        if(!empty($data)){
	        Status_Notification::where('id',$id)->update(
	            array(  
	                'last_read_date' => date('Y-m-d H:i:s')
	            ));
        }
	}

	protected function update_all_status_notification($user_id){
		$list_data = Status_Notification::where('id_user', '=', $user_id);
        if(count($list_data) > 0){
			foreach ($list_data as $data) {
				# code...
				$data->last_read_date = date('Y-m-d H:i:s');
			}
	        Status_Notification::update($list_data);
        }
	}

	protected function getListYears($year = null){
		$result = array();
		if(empty($year)) $year = date('Y');
		for($i=0; $i<= 5; $i++){
			$result = $result + array( ($year - $i) => ($year - $i));
		}
		return $result;
	}

	protected function get_list_status(){
		$result = array('Active' => 'Aktif', 'Not Active'  => 'Tidak Aktif');
		return $result;

	}

	protected function get_list_level_basic_education(){
		$result = array('TK' => 'TK', 'SD'  => 'SD', 'SLTP'  => 'SLTP', 'SLTA'  => 'SLTA');
		return $result;

	}

	protected function get_list_religion(){
		$result = array('Islam' => 'Islam', 'Kristen'  => 'Kristen', 'Hindu'  => 'Hindu', 'Budha'  => 'Budha', 'Lainnya'  => 'Lainnya');
		return $result;

	}

	protected function get_list_sex(){
		$result = array('L' => 'Laki-laki', 'P'  => 'Perempuan');
		return $result;
	}

	protected function get_list_region(){
		$result = array('dom' => 'Domestik', 'int'  => 'Internasional');
		return $result;
	}

	protected function get_list_shipping_company_grade(){
		$result = array('1' => 'I', '2'  => 'II');
		return $result;

	}

	protected function get_list_column_mi(){
		// $result = array('nip', 'name', 'birth_place', 'birth_date', 'religion', 'sex', 'phone1', 'phone2', 'phone3', 'address01', 'address02', 'address03', 'city', 'zipcode', 'email01', 'email02', 'description', 'status', 'functional_name', 'functional_description', 'functional_level', 'structural_name', 'structural_description', 'structural_level', 'harbour_master_name', 'harbour_master_description', 'emp_grade_name', 'emp_grade_description');
		$result = array('NIP', 'Name', 'Tempat Lahir', 'Tanggal Lahir', 'Agama', 'Jenis Kelamin', 'No HP', 'No Telp. Rumah', 'No Telp. Lainnya', 'Alamat',  'Kota', 'Kode Pos', 'Email Kantor', 'Email Pribadi', 'Keterangan', 'Status', 'Jabatan Fungsional', 'Level Jabatan Fungsional', 'Jabatan Struktural', 'Level Struktural', 'Unit Kerja', 'Wilayah Kerja', 'Pangkat & Golongan', 'Mi Type');
		return $result;
	}

	protected function get_list_column_mi_training(){
		$result = array('NIP', 'Name', 'Tempat Lahir', 'Tanggal Lahir', 'Agama', 'Jenis Kelamin', 'No HP', 'No Telp. Rumah', 'No Telp. Lainnya', 'Alamat',  'Kota', 'Kode Pos', 'Email Kantor', 'Email Pribadi', 'Keterangan', 'Status', 'Jenis Pelatihan', 'Tanggal Mulai', 'Tanggal Selesai', 'Tanggal Lulus', 'Tahun Lulus', 'No Sertifikasi', 'Kartu MI', 'Tanggal Pengukuhan', 'Keterangan Pelatihan', 'Refreshment', 'Status Pelatihan');
		return $result;
	}

	protected function get_list_column_mi_education(){
		// $result = array('nip', 'name', 'birth_place', 'birth_date', 'religion', 'sex', 'phone1', 'phone2', 'phone3', 'address01', 'address02', 'address03', 'city', 'zipcode', 'email01', 'email02', 'description', 'status', 'functional_name', 'functional_description', 'functional_level', 'structural_name', 'structural_description', 'structural_level', 'harbour_master_name', 'harbour_master_description', 'emp_grade_name', 'emp_grade_description', university_name, faculty_name, major_name, education_level, graduate_date, graduate_year, id_university,id_faculty, id_major, id_education_level );
		$result = array('NIP', 'Name', 'Tempat Lahir', 'Tanggal Lahir', 'Agama', 'Jenis Kelamin', 'No HP', 'No Telp. Rumah', 'No Telp. Lainnya', 'Alamat',  'Kota', 'Kode Pos', 'Email Kantor', 'Email Pribadi', 'Keterangan', 'Status', 'Jabatan Fungsional', 'Level Jabatan Fungsional', 'Jabatan Struktural', 'Level Struktural', 'Unit Kerja', 'Wilayah Kerja', 'Pangkat & Golongan', 'Universitas', 'Fakultas', 'Jurusan', 'Tingkat', 'Tanggal Lulus', 'Tahun Lulus');
		return $result;
	}

	protected function get_list_refreshment(){
		$result = array('1' => 'I', '2'  => 'II');
		return $result;

	}

    // http://stackoverflow.com/questions/21671179/how-to-generate-a-new-guid
    protected function GUID()
	    {
        if (function_exists('com_create_guid') === true)
        {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    protected function get_ext_file($filename){
    	$result = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    	return $result;
    }

    protected function resize_image($file, $w, $h, $crop=FALSE) {
	    list($width, $height) = getimagesize($file);
	    $r = $width / $height;
	    if ($crop) {
	        if ($width > $height) {
	            $width = ceil($width-($width*abs($r-$w/$h)));
	        } else {
	            $height = ceil($height-($height*abs($r-$w/$h)));
	        }
	        $newwidth = $w;
	        $newheight = $h;
	    } else {
	        if ($w/$h > $r) {
	            $newwidth = $h*$r;
	            $newheight = $h;
	        } else {
	            $newheight = $w/$r;
	            $newwidth = $w;
	        }
	    }
	    $src = imagecreatefromjpeg($file);
	    $dst = imagecreatetruecolor($newwidth, $newheight);
	    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

	    return $dst;
	}

	//http://www.nimrodstech.com/php-image-resize/
	//with little modification
	protected function smart_resize_image($file,
                              $string             = null,
                              $width              = 0, 
                              $height             = 0, 
                              $proportional       = false, 
                              $output             = 'file', 
                              $delete_original    = true, 
                              $use_linux_commands = false,
  							  $quality = 100
  		 ) {
      
	    if ( $height <= 0 && $width <= 0 ) return false;
	    if ( $file === null && $string === null ) return false;
	 
	    # Setting defaults and meta
	    $info                         = $file !== null ? getimagesize($file) : getimagesizefromstring($string);
	    $image                        = '';
	    $final_width                  = 0;
	    $final_height                 = 0;
	    list($width_old, $height_old) = $info;
		$cropHeight = $cropWidth = 0;
	 
	    # Calculating proportionality
	    if ($proportional) {
	      if      ($width  == 0)  $factor = $height/$height_old;
	      elseif  ($height == 0)  $factor = $width/$width_old;
	      else                    $factor = min( $width / $width_old, $height / $height_old );
	 
	      $final_width  = round( $width_old * $factor );
	      $final_height = round( $height_old * $factor );
	    }
	    else {
	      $final_width = ( $width <= 0 ) ? $width_old : $width;
	      $final_height = ( $height <= 0 ) ? $height_old : $height;
		  $widthX = $width_old / $width;
		  $heightX = $height_old / $height;
		  
		  $x = min($widthX, $heightX);
		  $cropWidth = ($width_old - $width * $x) / 2;
		  $cropHeight = ($height_old - $height * $x) / 2;
	    }
	 
	    # Loading image to memory according to type
	    switch ( $info[2] ) {
	      case IMAGETYPE_JPEG:  $file !== null ? $image = imagecreatefromjpeg($file) : $image = imagecreatefromstring($string);  break;
	      case IMAGETYPE_GIF:   $file !== null ? $image = imagecreatefromgif($file)  : $image = imagecreatefromstring($string);  break;
	      case IMAGETYPE_PNG:   $file !== null ? $image = imagecreatefrompng($file)  : $image = imagecreatefromstring($string);  break;
	      default: return false;
	    }
	    
	    
	    # This is the resizing/resampling/transparency-preserving magic
	    $image_resized = imagecreatetruecolor( $final_width, $final_height );
	    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
	      $transparency = imagecolortransparent($image);
	      $palletsize = imagecolorstotal($image);
	 
	      if ($transparency >= 0 && $transparency < $palletsize) {
	        $transparent_color  = imagecolorsforindex($image, $transparency);
	        $transparency       = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
	        imagefill($image_resized, 0, 0, $transparency);
	        imagecolortransparent($image_resized, $transparency);
	      }
	      elseif ($info[2] == IMAGETYPE_PNG) {
	        imagealphablending($image_resized, false);
	        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
	        imagefill($image_resized, 0, 0, $color);
	        imagesavealpha($image_resized, true);
	      }
	    }
	    imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);
		
    
	    # Writing image according to type to the output destination and image quality
	    $result  = null;
	    ob_start();
	    switch ( $info[2] ) {
	      case IMAGETYPE_GIF:   imagegif($image_resized, $output);    break;
	      case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output, $quality);   break;
	      case IMAGETYPE_PNG:
	        $quality = 9 - (int)((0.9*$quality)/10.0);
	        imagepng($image_resized, $output, $quality);
	        break;
	      // default: return false;
	    }

	    $result = ob_get_contents();
	    ob_end_clean();
	 
	    return $result;
	  }	


}
