<?php
// use Illuminate\Database\Eloquent\SoftDeletingTrait;
class RolePermission extends Eloquent
{
    // use SoftDeletingTrait;
    public $timestamps = false;
    
    protected $table = 'role_permission';
    protected $fillable = ['role_slug', 'permission'];

}