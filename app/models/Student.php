<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Student extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;

    protected $table = 'students';
    protected $hidden = array('password', 'remember_token');
    protected $fillable = [
        'family_id','fullname', 'username', 'fullname', 'email', 'password', 'phone', 'code',
        'center_id','class_id', 'date_study', 'model_id', 'model_name', 'birthday',
        'gender', 'address', 'school', 'link_fb',
        'description', 'time_target', 'info_user', 'comment'
    ];

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
    
    public function families() 
    {
        return $this->hasMany('Family', 'group_id', 'family_id');
    }
}