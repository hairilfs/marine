<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class emp_education extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'emp_education';
	protected $guard = array();
	protected $fillable = array('id_university', 'id_faculty','id_major','id_emp','graduate_year','graduate_date', 'location', 'professor','id_certificate_file','description','status');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();

	// public funtion get_data(){
	// 	return self::paginate(5)
	// }

}
