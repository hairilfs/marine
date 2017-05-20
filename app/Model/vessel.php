<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class vessel extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'vessel';
	protected $guard = array();
	protected $fillable = array( 'vessel_name', 'vessel_type', 'call_sign', 'imo_number', 'mmsi_number', 'certificate', 'id_shipping_company', 'status', 'description');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();

	// public funtion get_data(){
	// 	return self::paginate(5)
	// }

}
