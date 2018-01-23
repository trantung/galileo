<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ParentModel extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;

    protected $table = 'parents';
    protected $hidden = array('password', 'remember_token');
    protected $fillable = ['email', 'password', 'username', 'phone'];
    protected $dates = ['deleted_at'];

    public function students() 
    {
        return $this->belongsToMany('Student', 'parent_student', 'student_id', 'parent_id');
    }

}