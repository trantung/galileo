<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Introduce extends Eloquent
{
	use SoftDeletingTrait;
    protected $table = 'introduces';
    protected $fillable = ['position', 'title', 'description', 'css'];
    protected $dates = ['deleted_at'];

}