<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class AboutUs extends Eloquent
{
	use SoftDeletingTrait;
    protected $table = 'about_us';
    protected $fillable = ['title', 'description', 'image_url', 'type_id', 'slug', 'weight'];
    protected $dates = ['deleted_at'];

    public function typeAboutUs()
    {
    	return $this->belongsTo('TypeAboutUs', 'type_id', 'id');
    }

}