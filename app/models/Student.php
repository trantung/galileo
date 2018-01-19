<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Student extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;

    protected $table = 'students';
    protected $hidden = array('password', 'remember_token');
    protected $fillable = ['email', 'password', 'username', 'phone'];
    protected $dates = ['deleted_at'];

    public function parents() 
	{
		return $this->belongsToMany('Parent', 'parent_student', 'parent_id', 'student_id');
	}

}