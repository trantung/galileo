<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class DocumentAdditional extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;
    
    protected $table = 'document_additionals';
    protected $fillable = [
    	'level_id', 'subject_id', 'class_id',
    	'name', 'code', 'file_url', 
    	'student_id', 'user_id', 'lesson_id',
    	'order', 'status', 'type_id', 'parent_id'
    ];

    protected $dates = ['deleted_at'];
}