<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class harbour_master extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'harbour_master';
	protected $guard = array();
	protected $fillable = array( 'id_harbour_area','name','description','id_grade','phone1','phone2','phone3','address01','address02','address03', 'city', 'zipcode','email','web_address','status');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();

	// public funtion get_data(){
	// 	return self::paginate(5)
	// }
	// 

}
