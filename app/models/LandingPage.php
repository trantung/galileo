<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class LandingPage extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;
    
    protected $table = 'landing_pages';
    protected $fillable = [
    	'parent_name', 'fullname','phone', 'email', 'class', 'period_1',
    	'period_2','period_3', 'period_4', 'address', 'check_subject','status',
    	'comment', 'utm_source','utm_medium','utm_campaign','utm_term','landing_id'
    ];

   
}