<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class certificate_task_shipping extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'certificate_task_shipping';
	protected $guard = array();
	protected $fillable = array( 'name', 'status','description');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();

	// public funtion get_data(){
	// 	return self::paginate(5)
	// }

}
