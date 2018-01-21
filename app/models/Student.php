<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Student extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;

    protected $table = 'students';
    protected $hidden = array('password', 'remember_token');
    protected $fillable = ['center_id', 'email', 'password', 'username', 'phone', 'fullname', 'code', 'class_id', 'date_study', 'author', 'birthday', 'gender', 'address', 'school', 'dad_fullname', 'dad_phone', 'mom_fullname', 'mom_phone', 'link_fb', 'description', 'time_target', 'info_user', 'comment', 'number_program', 'model_name', 'model_id',  'program_learned', 'program_current'];
    protected $dates = ['deleted_at'];

    public function parents() 
	{
		return $this->belongsToMany('Parent', 'parent_student', 'parent_id', 'student_id');
	}

    public function levels() 
    {
        return $this->belongsToMany('Level', 'student_level', 'student_id', 'level_id');
    }

    public function centers() 
    {
        return $this->belongsTo('Center', 'center_id', 'id');
    }

    public function classes() 
    {
        return $this->belongsTo('ClassModel', 'class_id', 'id');
    }
}