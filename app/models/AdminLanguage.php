<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class AdminLanguage extends Eloquent
{
	use SoftDeletingTrait;
    protected $table = 'languages';
    protected $fillable = ['model_name', 'model_id', 'relate_id', 'relate_name', 'position', 'status'];
    protected $dates = ['deleted_at'];

}