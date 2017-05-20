<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class emp_experience extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'emp_experience';
	protected $guard = array();
	protected $fillable = array('id_emp','position','start_date', 'end_date', 'level_position','basic_salary','officer', 'letter_of_number', 'letter_date', 'id_certificate_file');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();

	// public funtion get_data(){
	// 	return self::paginate(5)
	// }

}
