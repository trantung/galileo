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
    	'name', 'code', 'status', 'author_by', 'type_id'];

    // protected $hidden = array('password', 'remember_token');
    protected $dates = ['deleted_at'];

}