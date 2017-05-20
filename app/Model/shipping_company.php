<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class shipping_company extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'shipping_company';
	protected $guard = array();
	protected $fillable = array( 'reg_no','name','phone1','phone2','phone3', 'address01', 'address02','address03','city','zipcode','email01','email02', 'location', 'branch', 'upper_id','grade','description','status');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();

	// public funtion get_data(){
	// 	return self::paginate(5)
	// }

}
