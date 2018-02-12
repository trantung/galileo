<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ClassModel extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;
    
    protected $table = 'classes';
    protected $fillable = ['name', 'code'];
    protected $dates = ['deleted_at'];

	public function subjects() 
	{
		return $this->belongsToMany('Subject', 'subject_class', 'class_id', 'subject_id');

	}

	public function students() 
    {
        return $this->hasMany('Student', 'class_id', 'id');
    }
}