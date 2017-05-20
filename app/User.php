<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Cmgmyr\Messenger\Traits\Messagable;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract 
{

    use Authenticatable, Authorizable, CanResetPassword, Messagable;

    protected $primaryKey = 'id';
    protected $table = 'user';
    protected $guard = array();
    protected $fillable = array('username', 'email', 'last_login', 'ip_address', 'is_active', 'id_role', 'id_employee', 'is_active');
    protected $hidden = ['password', 'remember_token', 'created_date', 'created_by', 'updated_date', 'updated_by'];

    public $timestamps = false;
    public static $rules = array();

    public function roles(){
        return $this->hasOne('App\Model\Role', 'id', 'id_role');
    }

    public function is_admin(){
        return $this->roles->is_admin;
    }

    public function employee_profile(){
        return $this->hasOne('App\Model\employee_profile', 'id', 'id_employee');
    }

    //http://heera.it/laravel-5-1-x-acl-middleware#.Vnf6Avl97IV
    public function valid($module){
        return !is_null($module) && $this->check_permission($module);
    }

    public function check_permission($module){
        $modules = $this->get_mapped_module();
        return;
    }

    public  function get_mapped_module()
    {
        $modules = [];
        $modules = $this->roles->load('mapping_role_module')->fetch('mapping_role_module')->load('module')->fetch('module')->toArray();
    }

    public function getAuthIdentifier()
    {
      return $this->getKey();
    }
    
    public function getAuthPassword()
    {
      return $this->password;
    } 
    
    public function getRememberToken()
    {
      return $this->remember_token;
    }
    
    public function setRememberToken($value)
    {
      $this->remember_token = $value;
    }
    
    public function getRememberTokenName()
    {
      return "remember_token";
    }
    
    public function getReminderEmail()
    {
      return $this->email;
    }

    public function get_photo_id(){
        $ep = $this->employee_profile;
        if($ep!= null){
            return $ep->id_photo;
        }
        return 0;
    }

}
