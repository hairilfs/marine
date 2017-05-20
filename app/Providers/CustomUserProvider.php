<?php namespace App\Providers;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Contract\Auth\User as UserContract;
use Illuminate\Contracts\Auth\Authenticatable;
// use App\Model\User;
use App\User;

/*
 *	http://laravel.io/forum/11-04-2014-laravel-5-how-do-i-create-a-custom-auth-in-laravel-5
 *	http://www.karlvalentin.de/1903/write-your-own-auth-driver-for-laravel-4.html
 *	You may refer to class EloquentUserProvider
 */
class CustomUserProvider implements UserProvider{

	protected $hasher;
	protected $model;

	// public function __construct(HasherContract $hasher, $model)
	public function __construct(HasherContract $hasher, $model)
	{
		$this->hasher = $hasher;
		$this->model = $model;
	}

	/**
	 * Retrieve a user by their unique identifier.
	 *
	 * @param  mixed  $identifier
	 * @return \Illuminate\Contracts\Auth\Authenticatable|null
	 */
	public function retrieveById($identifier){
		$user = $this->model->where('id', '=', $identifier)->first();
		return $user;
	}

	/**
	 * Retrieve a user by by their unique identifier and "remember me" token.
	 *
	 * @param  mixed   $identifier
	 * @param  string  $token
	 * @return \Illuminate\Contracts\Auth\Authenticatable|null
	 */
	public function retrieveByToken($identifier, $token){
		$user = $this->model->where('id', '=', $identifier)->where('token', '=', $token)->first();
		return $user;
	}

	/**
	 * Update the "remember me" token for the given user in storage.
	 *
	 * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
	 * @param  string  $token
	 * @return void
	 */
	public function updateRememberToken(Authenticatable $user, $token){
		if(isset($model)){
			$data =  $model->where('username', '=', $user->Username)->first();
			if(!empty($data)){
				$data->Token = $token;
				$data->save();
			}			
		}
	}

	/**
	 * Retrieve a user by the given credentials.
	 *
	 * @param  array  $credentials
	 * @return \Illuminate\Contracts\Auth\Authenticatable|null
	 */
	public function retrieveByCredentials(array $credentials){
		$user = $this->model->where('username', '=', $credentials['Username'])->first();
		return $user;	
	}

	/**
	 * Validate a user against the given credentials.
	 *
	 * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
	 * @param  array  $credentials
	 * @return bool
	 */
	public function validateCredentials(Authenticatable $user, array $credentials){
		// $is_valid = $this->model->where('Username', '=', $credentials['Username'])->where('Password', '=', $credentials['Password'])->first() != null;
		$is_valid = $user->username == $credentials['Username'] && $this->hasher->check($credentials['Password'], $user->getAuthPassword());
		return $is_valid;	

		// $plain = $credentials['password'];
		// return $this->hasher->check($plain, $user->getAuthPassword());
	}

}
