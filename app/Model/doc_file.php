<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class doc_file extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'doc_file';
	protected $guard = array();
	protected $fillable = array('name', 'original_filename', 'file', 'description');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();

	// public funtion get_data(){
	// 	return self::paginate(5)
	// }

}
