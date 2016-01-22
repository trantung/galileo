<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class AdminSlide extends Eloquent
{
	use SoftDeletingTrait;
    protected $table = 'slide';
    protected $fillable = ['name', 'description', 'link', 'type', 'image_url'];
    protected $dates = ['deleted_at'];

}