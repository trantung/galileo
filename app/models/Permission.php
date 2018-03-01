<?php
// use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Permission extends Eloquent
{
    // use SoftDeletingTrait;
    public $timestamps = true;
    
    protected $table = 'permissions';
    protected $fillable = ['controller', 'action', 'model', 'group_id'];

    public function groups() 
    {
        return $this->belongsToMany('PermissionGroup', 'relation_per_group', 'permission_id', 'group_id');

    }
}