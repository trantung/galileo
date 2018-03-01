<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class PermissionGroup extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;
    
    protected $table = 'groups';
    protected $fillable = ['name', 'code', 'status'];

    public function permissions() 
    {
        return $this->belongsToMany('Permission', 'relation_per_group', 'group_id', 'permission_id');

    }
}