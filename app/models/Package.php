<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Package extends Eloquent
{
	use SoftDeletingTrait;
    public $timestamps = true;
    
    protected $table = 'packages';
    protected $fillable = ['name', 'lesson_per_week', 'total_lesson', 'price', 'duration', 'max_student'];
    protected $dates = ['deleted_at'];

}