<?php
// use Illuminate\Auth\UserTrait;
// use Illuminate\Auth\UserInterface;
// use Illuminate\Auth\Reminders\RemindableTrait;
// use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

// class SubjectClass extends Eloquent implements UserInterface, RemindableInterface
class SubjectClass extends Eloquent
{
    use SoftDeletingTrait;
    // use UserTrait, RemindableTrait;
    public $timestamps = true;
    protected $table = 'subject_class';
    protected $fillable = ['subject_id', 'class_id'];


    // protected $hidden = array('password', 'remember_token');
    protected $dates = ['deleted_at'];

    public function levels()
    {
        return $this->hasMany('Level', 'subject_class_id', 'id');
    }
}