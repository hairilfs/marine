<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class employee_photo extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'employee_photo';
	protected $guard = array();
	protected $fillable = array('name', 'original_filename', 'file');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();

	// public funtion get_data(){
	// 	return self::paginate(5)
	// }

}
