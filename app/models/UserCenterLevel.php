<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class UserCenterLevel extends Eloquent
{
	use SoftDeletingTrait;
    public $timestamps = true;
    
    protected $table = 'user_center_level';
    protected $fillable = ['user_id', 'center_level_id', 'level_id'];
    protected $dates = ['deleted_at'];
}