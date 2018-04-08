<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class AskPermission extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;
    
    protected $table = 'ask_permissions';
    protected $fillable = ['model_id', 'model_name','document_id', 'document_code', 'status'];

   
}