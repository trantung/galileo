<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Subject extends Eloquent {

	//use SoftDeletingTrait;
    //protected $dates = ['deleted_at'];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'subjects';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = array('password', 'remember_token');
	 protected $fillable = array('subject_name');

}
