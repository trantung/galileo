<?php
// use Illuminate\Database\Eloquent\SoftDeletingTrait;
class AccessPermisison extends Eloquent
{
    // use SoftDeletingTrait;
    public $timestamps = true;
    
    protected $table = 'access_permission';
    protected $fillable = ['model_name', 'model_id', 'permission_id', 'subject_id', 'group_id'];
   
}