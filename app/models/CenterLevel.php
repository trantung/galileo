<?php

class CenterLevel extends Eloquent
{
    public $timestamps = true;
    
    protected $table = 'center_level';
    protected $fillable = ['center_id', 'level_id'];

}