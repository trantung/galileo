<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Center extends Eloquent {

	//use SoftDeletingTrait;
    //protected $dates = ['deleted_at'];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'centers';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = array('password', 'remember_token');
	 protected $fillable = array('partner_id', 'center_name');

	public function partner()
    {
        return $this->hasOne('Partner', 'id', 'partner_id');
    }
    public function employees()
    {
    	return $this->hasMany('employees');
    }
}
