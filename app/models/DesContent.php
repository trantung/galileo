<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class DesContent extends Eloquent
{
	use SoftDeletingTrait;
    protected $table = 'des_contents';
    protected $fillable = ['title', 'description', 'slug'];
    protected $dates = ['deleted_at'];

}