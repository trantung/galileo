<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	use SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	protected $fillable = array('email', 'password', 'role_id', 'username', 'personal_email', 
		'center_id', 'phone', 'start_date', 'end_date', 'birth_day', 'current_address', 'address', 'id_number', 'id_date', 'id_provide', 'job', 'full_name'
	);
    protected $dates = ['deleted_at'];

    public function center() 
    {
        return $this->belongsTo('Center', 'center_id', 'id');

    }
    public function free_time_user()
    {
    	return $this->hasMany('FreeTimeUser', 'user_id', 'id');
    }
}
