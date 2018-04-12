<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class LandingPageName extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;
    
    protected $table = 'landing_page_names';
    protected $fillable = [
    	'name'
    ];

   
}