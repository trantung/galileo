<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class TypeAboutUs extends Eloquent
{
	use SoftDeletingTrait;
    protected $table = 'type_about_us';
    protected $fillable = ['name', 'name_shadow', 'slug', 'position', 'sort'];
    protected $dates = ['deleted_at'];

    public function aboutUs()
    {
        return $this->hasMany('AboutUs', 'type_id', 'id');
    }

}