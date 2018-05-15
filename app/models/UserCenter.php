<?php
// use Illuminate\Database\Eloquent\SoftDeletingTrait;
class UserCenter extends Eloquent
{
	// use SoftDeletingTrait;
    public $timestamps = true;
    
    protected $table = 'user_center';
    protected $fillable = ['user_id', 'center_id'];
}