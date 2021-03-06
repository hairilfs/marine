<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class directory_document extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'directory_document';
	protected $guard = array();
	protected $fillable = array('name', 'parent_id', 'is_public_folder', 'description');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();

	// public funtion get_data(){
	// 	return self::paginate(5)
	// }

}
