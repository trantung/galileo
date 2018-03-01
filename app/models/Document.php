<?php
// use Illuminate\Auth\UserTrait;
// use Illuminate\Auth\UserInterface;
// use Illuminate\Auth\Reminders\RemindableTrait;
// use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

// class AdminLevel extends Eloquent implements UserInterface, RemindableInterface
class Document extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;
    
    protected $table = 'documents';
    protected $fillable = ['level_id', 'subject_id', 'class_id',
    	'name', 'code', 'status', 'author_by', 'type_id', 'lesson_id', 'parent_id', 'file_url', 'order'];

    // protected $hidden = array('password', 'remember_token');
    protected $dates = ['deleted_at'];

    public function classes() 
    {
        return $this->belongsTo('ClassModel', 'class_id', 'id');
    }

    public function subjects() 
    {
        return $this->belongsTo('Subject', 'subject_id', 'id');
    }

    public function levels() 
    {
        return $this->belongsTo('Level', 'level_id', 'id');
    }

    public function lessons() 
    {
        return $this->belongsTo('Lesson', 'lesson_id', 'id');
    }

}