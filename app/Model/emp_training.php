<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class emp_training extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'emp_training';
	protected $guard = array();
	protected $fillable = array( 'id_training', 'id_employee_profile','date_taken_from','date_taken_to','graduate_date','graduate_year','certificate_no','mi_card','mi_date','id_certificate_file','id_mi_card_file', 'description', 'refreshment', 'location', 'status');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();

	// public funtion get_data(){
	// 	return self::paginate(5)
	// }

}
