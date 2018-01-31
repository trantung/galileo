<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class StudentLevel extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;

    protected $table = 'student_level';
    protected $fillable = ['student_id','level_id', 'class_id', 'subject_id'];
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

    public function students() 
    {
        return $this->belongsTo('Student', 'student_id', 'id');
    }

}