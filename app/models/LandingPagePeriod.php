<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class LandingPagePeriod extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;
    
    protected $table = 'landing_page_periods';
    protected $fillable = [
    	'name',
    ];
   
}