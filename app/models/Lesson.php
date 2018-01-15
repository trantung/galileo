<?php
// use Illuminate\Auth\UserTrait;
// use Illuminate\Auth\UserInterface;
// use Illuminate\Auth\Reminders\RemindableTrait;
// use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

// class AdminLevel extends Eloquent implements UserInterface, RemindableInterface
class Lesson extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;
    
    protected $table = 'lessons';
    protected $fillable = ['level_id', 'subject_id', 'class_id', 'name', 'code', 'status'];

    // protected $hidden = array('password', 'remember_token');
    protected $dates = ['deleted_at'];

    public function levels() 
    {
        return $this->belongsTo('Level', 'level_id', 'id');
    }

    public function documents() 
    {
        return $this->hasMany('Document', 'lesson_id', 'id');
    }
}