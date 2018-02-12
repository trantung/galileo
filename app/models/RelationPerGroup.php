<?php
// use Illuminate\Database\Eloquent\SoftDeletingTrait;
class RelationPerGroup extends Eloquent
{
    // use SoftDeletingTrait;
    public $timestamps = true;
    
    protected $table = 'relation_per_group';
    protected $fillable = ['group_id', 'permission_id'];
   
}