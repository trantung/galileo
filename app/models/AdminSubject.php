<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class AdminSubject extends Eloquent
{
	use SoftDeletingTrait;
    protected $table = 'subjects';
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];

    public function subjects() 
	{
		return $this->belongsToMany('AdminClass', 'subject_class', 'subject_id', 'class_id');

	}
	
}