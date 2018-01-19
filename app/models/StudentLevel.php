<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class StudentLevel extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;

    protected $table = 'student_level';
    protected $fillable = ['student_id','level_id', 'class_id', 'subject_id'];
    protected $dates = ['deleted_at'];

    

}