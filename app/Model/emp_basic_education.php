<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class emp_basic_education extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'emp_basic_education';
	protected $guard = array();
	protected $fillable = array('id_emp','level_education','school_name', 'graduate_year', 'location','head_master', 'id_certificate_file','description');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();

	// public funtion get_data(){
	// 	return self::paginate(5)
	// }

}
