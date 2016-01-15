<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Language extends Eloquent
{
	use SoftDeletingTrait;
    protected $table = 'languages';
    protected $fillable = ['model_name', 'model_id', 'relate_id', 'relate_name'];
    protected $dates = ['deleted_at'];

}