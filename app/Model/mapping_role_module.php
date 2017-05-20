<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class mapping_role_module extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'mapping_role_module';
	protected $guard = array();
	protected $fillable = array('id_role', 'id_module', 'is_granted_to_view', 'is_granted_to_add', 'is_granted_to_edit', 'is_granted_to_delete', 'is_granted_to_download', 'url');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();

    public function roles(){
        return $this->belongsToMany('App\Model\Role', 'id', 'id_role');
    }

    public function module(){
        return $this->belongsToMany('App\Model\module', 'id', 'id_module');
    }

	// public funtion get_data(){
	// 	return self::paginate(5)
	// }

}
