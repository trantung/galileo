<?php
// use Illuminate\Auth\UserTrait;
// use Illuminate\Auth\UserInterface;
// use Illuminate\Auth\Reminders\RemindableTrait;
// use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

// class AdminLevel extends Eloquent implements UserInterface, RemindableInterface
class Level extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;
    
    protected $table = 'levels';
    protected $fillable = ['name', 'subject_class_id', 'subject_id', 'class_id', 'code', 'number_lesson'];

    // protected $hidden = array('password', 'remember_token');
    protected $dates = ['deleted_at'];

    public function subject_class()
    {
        return $this->belongsTo('SubjectClass', 'subject_class_id', 'id');
    }

    public function centers() 
    {
        return $this->belongsToMany('Level', 'center_level', 'level_id', 'center_id');

    }

    public function classes() 
    {
        return $this->belongsTo('ClassModel', 'class_id', 'id');
    }

    public function subjects() 
    {
        return $this->belongsTo('Subject', 'subject_id', 'id');
    }

    public function lessons() 
    {
        return $this->hasMany('Lesson', 'level_id', 'id');
    }

    public function students() 
    {
        return $this->belongsToMany('Student', 'student_level', 'level_id', 'student_id');
    }
}