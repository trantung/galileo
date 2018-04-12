<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class LandingPagePeriodRelation extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;
    
    protected $table = 'landing_page_relation_periods';
    protected $fillable = [
    	'landing_page_id', 'period_id'
    ];
   
}