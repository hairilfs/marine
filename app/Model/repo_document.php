<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class repo_document extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'repo_document';
	protected $guard = array();
	protected $fillable = array('id_emp', 'id_file', 'id_version', 'id_dir', 'id_doc_type', 'title', 'description' 'date_upload', 'status');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();

	// public funtion get_data(){
	// 	return self::paginate(5)
	// }

}
