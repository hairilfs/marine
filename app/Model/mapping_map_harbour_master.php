<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class mapping_map_harbour_master extends \Eloquent {

	//
	protected $primaryKey = 'id';
	protected $table = 'mapping_map_harbour_master';
	protected $guard = array();
	protected $fillable = array('id_harbour_master', 'x', 'y');
	protected $hidden = ['created_date', 'created_by', 'updated_date', 'updated_by'];

	public $timestamps = false;
	public static $rules = array();

    public function harbour_master(){
        return $this->belongsToMany('App\Model\Harbour_Master', 'id', 'id_harbour_master');
    }
    


}
