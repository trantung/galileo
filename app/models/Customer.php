<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Customer extends Eloquent
{
	use SoftDeletingTrait;
    protected $table = 'customers';
    protected $fillable = ['name', 'email', 'phone', 'message'];
    protected $dates = ['deleted_at'];

}