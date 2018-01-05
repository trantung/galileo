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
    protected $fillable = ['name', 'subject_class_id'];

    // protected $hidden = array('password', 'remember_token');
    protected $dates = ['deleted_at'];

    public function subject_class()
    {
        return $this->belongsTo('SubjectClass', 'subject_class_id', 'id');
    }
}