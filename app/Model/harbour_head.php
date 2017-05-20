<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class harbour_head extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'harbour_head';
	protected $guard = array();
	protected $fillable = array('id_harbour', 'id_emp');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();

	// public funtion get_data(){
	// 	return self::paginate(5)
	// }

}
