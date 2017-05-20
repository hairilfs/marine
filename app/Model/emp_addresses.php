<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class emp_addresses extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'emp_addresses';
	protected $guard = array();
	protected $fillable = array('id_emp','jalan','kelurahan', 'kecamatan', 'kabupaten','provinsi','is_current');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();

	// public funtion get_data(){
	// 	return self::paginate(5)
	// }

}
