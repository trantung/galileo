<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Subject extends Eloquent
{
    use SoftDeletingTrait;
    
    protected $table = 'subjects';
    protected $fillable = ['subject_name'];

    protected $dates = ['deleted_at'];
}