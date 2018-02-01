<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Employees extends Eloquent {

	//use SoftDeletingTrait;
    //protected $dates = ['deleted_at'];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'employees';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = array('password', 'remember_token');
	 protected $fillable = array('center_id','employees_name');
	 //
	 public function center()
    {
        return $this->hasOne('Center', 'id', 'center_id');
    }

}
