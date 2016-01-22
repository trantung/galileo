<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class BottomText extends Eloquent
{
	use SoftDeletingTrait;
    protected $table = 'bottom_texts';
    protected $fillable = ['title', 'description', 'link', 'status'];
    protected $dates = ['deleted_at'];

}