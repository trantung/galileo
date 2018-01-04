<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ClassModel extends Eloquent
{
    use SoftDeletingTrait;
    
    protected $table = 'classes';
    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];
}