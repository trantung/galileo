<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class AdminClass extends Eloquent
{
	use SoftDeletingTrait;
    protected $table = 'classes';
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];

	public function subjects() 
	{
		return $this->belongsToMany('AdminSubject', 'subject_class', 'class_id', 'subject_id');

	}
}