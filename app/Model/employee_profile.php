<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class employee_profile extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'employee_profile';
	protected $guard = array();
	// protected $fillable = array( 'nip','name','birth_place','birth_date','religion','sex','id_photo','phone1','phone2','phone3', 'address01', 'address02','address03','city','zipcode','email01','email02','description','status','id_functional','id_structural','id_harbour','id_grade', 'struct_bidang', 'struct_seksi', 'status_desc', 'npwp', 'marital_status', 'hobby');
	protected $fillable = array( 'nip','name','birth_place','birth_date','religion','sex','id_photo','phone1','phone2','phone3', 'email01','email02','description','status','id_functional','id_structural','id_harbour','id_grade', 'struct_bidang', 'struct_seksi', 'status_desc', 'npwp', 'marital_status', 'hobby');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();


	public function user(){
		return $this->belongsTo('App\User', 'id', 'id_employee');
	}


}
