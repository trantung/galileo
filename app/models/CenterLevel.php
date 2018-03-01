<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class CenterLevel extends Eloquent
{
	use SoftDeletingTrait;
    public $timestamps = true;
    
    protected $table = 'center_level';
    protected $fillable = ['center_id', 'level_id'];
    protected $dates = ['deleted_at'];

}