<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class AboutUs extends Eloquent
{
	use SoftDeletingTrait;
    protected $table = 'about_us';
    protected $fillable = ['title', 'description', 'lat', 'long', 'slug'];
    protected $dates = ['deleted_at'];

}