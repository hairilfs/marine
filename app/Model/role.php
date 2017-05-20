<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class role extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'role';
	protected $guard = array();
	protected $fillable = array('name', 'is_admin', 'id');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();

	public function user(){
		return $this->belongsToMany('App\User', 'id_role', 'id');
	}

	public function mapping_role_module(){
		return $this->belongsToMany('App\Model\mapping_role_module', 'id_role', 'id');
	}

	public function is_allowed_module($url_module){
		$list_module = $this->mapping_role_module->module;
		foreach ($list_module as $m) {
			# code...
			if($m->url == $url_module) return true;
		}
		return false;
	}

    public function getName()
    {
      return $this->name;
    } 

}
