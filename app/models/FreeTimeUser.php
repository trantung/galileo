<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class FreeTimeUser extends Eloquent
{
    // use SoftDeletingTrait;
    public $timestamps = true;
    protected $table = 'free_time_user';
    protected $fillable = ['user_id', 'time_id', 'start_time', 'end_time'];
    protected $dates = ['deleted_at'];

	public function users() 
	{
		return $this->belongsTo('User','user_id','id');

	}
}