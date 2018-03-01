<?php
// use Illuminate\Auth\UserTrait;
// use Illuminate\Auth\UserInterface;
// use Illuminate\Auth\Reminders\RemindableTrait;
// use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

// class AdminLevel extends Eloquent implements UserInterface, RemindableInterface
class DocumentType extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;
    
    protected $table = 'types';
    protected $fillable = ['name', 'code', 'status'];

    // protected $hidden = array('password', 'remember_token');
    protected $dates = ['deleted_at'];

}