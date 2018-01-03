<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Center extends Eloquent {

	use SoftDeletingTrait;

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
	protected $fillable = array('name', 'phone',
		'address', 'code', 'partner_id'
	);
    protected $dates = ['deleted_at'];


}
