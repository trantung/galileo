<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class PermissionGroup extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;
    
    protected $table = 'groups';
    protected $fillable = ['name', 'code', 'status'];
   
}