<?php

class UserCenterLevel extends Eloquent
{
    public $timestamps = true;
    
    protected $table = 'user_center_level';
    protected $fillable = ['user_id', 'center_level_id'];

}