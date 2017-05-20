<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class status_notification extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'status_notification';
	protected $guard = array();
	protected $fillable = array('code', 'id_user', 'message', 'last_read_date', 'url_action');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();

	// public funtion get_data(){
	// 	return self::paginate(5)
	// }

}
