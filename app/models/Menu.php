<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Menu extends Eloquent
{
	use SoftDeletingTrait;
    protected $table = 'menus';
    protected $fillable = ['model_id', 'model_name', 'title', 'slug', 'position'];
    protected $dates = ['deleted_at'];

}