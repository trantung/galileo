<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Family extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;

    protected $table = 'family';
    protected $hidden = array('password', 'remember_token');
    protected $fillable = ['group_id', 'username', 'email', 'password', 'address', 'fullname', 'phone', 'gender'];
    protected $dates = ['deleted_at'];

   public function students() 
    {
        return $this->hasMany('Family', 'id', 'family_id');
    }
}