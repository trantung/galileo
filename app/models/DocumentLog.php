<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class DocumentLog extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;
    
    protected $table = 'document_log';
    protected $fillable = [
        'model_name', 'model_id', 'quantity_download',
    	'level_id', 'subject_id', 'class_id',
    	'name', 'code', 'file_url', 'document_id', 
    	'student_id', 'user_id', 'lesson_id',
    	'order', 'status', 'type_id', 'parent_id'
    ];

    protected $dates = ['deleted_at'];
}