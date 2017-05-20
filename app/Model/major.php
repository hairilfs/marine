<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class major extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'major';
	protected $guard = array();
	protected $fillable = array('name', 'description','status');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();

	// public funtion get_data(){
	// 	return self::paginate(5)
	// }

}
