<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class education_level extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'education_level';
	protected $guard = array();
	protected $fillable = array('name');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();

	// public funtion get_data(){
	// 	return self::paginate(5)
	// }

}
