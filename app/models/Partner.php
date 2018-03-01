<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Partner extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;
    use SoftDeletingTrait;
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'partners';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = array('password', 'remember_token');

    public function center()
    {
        return $this->hasMany('centers');
    }

    protected $hidden = array('password', 'remember_token');
    protected $fillable = array('email', 'password', 'username', 'phone',
        'address', 'name'
    );
    protected $dates = ['deleted_at'];
}