<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Partner extends Eloquent {

	//use SoftDeletingTrait;
    //protected $dates = ['deleted_at'];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'partners';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = array('password', 'remember_token');
	 protected $fillable = array('partner_name');

	public function center()
    {
        return $this->hasMany('centers');
    }

}
