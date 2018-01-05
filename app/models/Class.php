<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Class extends Eloquent
{
    use SoftDeletingTrait;
    
    protected $table = 'classes';
    protected $fillable = ['class_name'];

    protected $dates = ['deleted_at'];
}