<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Footer extends Eloquent
{
	use SoftDeletingTrait;
    protected $table = 'footers';
    protected $fillable = ['title', 'phone', 'fax', 'email', 'slug'];
    protected $dates = ['deleted_at'];

}