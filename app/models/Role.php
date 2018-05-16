<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Role extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;

     protected $sluggable = array(
        'build_from' => 'name',
        'save_to'    => 'code',
        // 'separator' => '_'
    );
    
    protected $table = 'roles';
    protected $fillable = ['name', 'code', 'status'];
   
}