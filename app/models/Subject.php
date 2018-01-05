<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Subject extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;

    protected $table = 'subjects';
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];

    public function subjects() 
	{
		return $this->belongsToMany('ClassModel', 'subject_class', 'subject_id', 'class_id');
	}
}