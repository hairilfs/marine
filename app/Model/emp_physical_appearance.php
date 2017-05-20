<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class emp_physical_appearance extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'emp_physical_appearance';
	protected $guard = array();
	protected $fillable = array('id_emp','height','weight', 'hair', 'facial_shape','skin_color','distinguishable', 'body_part_defect', 'blood_type');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();

	// public funtion get_data(){
	// 	return self::paginate(5)
	// }

}
