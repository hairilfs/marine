<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class shipping_task extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'shipping_task';
	protected $guard = array();
	protected $fillable = array( 'id_shipping_company', 'id_vessel', 'id_employee_profile', 'date_inspection', 'location', 'country', 'id_harbour_master', 'id_certificate', 'date_expired', 'id_certificate_file', 'description');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();

	// public funtion get_data(){
	// 	return self::paginate(5)
	// }

}
