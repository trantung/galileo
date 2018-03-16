<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Center extends Eloquent {
    use SoftDeletingTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'centers';
    public $timestamps = true;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $fillable = array('name', 'phone','address', 'code', 'partner_id');
    protected $dates = ['deleted_at'];

    public function levels() 
    {
        return $this->belongsToMany('Level', 'center_level', 'center_id', 'level_id');

    }
    public function partner() 
    {
        return $this->belongsTo('Partner', 'partner_id');

    }

    public function students() 
    {
        return $this->hasMany('Student', 'center_id', 'id');
    }

}
