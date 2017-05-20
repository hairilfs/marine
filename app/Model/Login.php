<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Login extends Model {

	//
	protected $primaryKey = 'Id';
	protected $table = 'login';
	protected $guard = array();
	protected $fillable = array();
	protected $hidden = ['CreatedDate', 'CreatedBy', 'UpdatedDate', 'UpdatedBy'];

	public $timestamps = false;
	public static $rules = aaray();

	public funtion getData(){
		return self::paginate(5)
	}

}
