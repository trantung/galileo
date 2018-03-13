<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class SpDetail extends Eloquent {

    use SoftDeletingTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sp_detail';
    public $timestamps = true;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $fillable = array(
        'student_id', 'center_id', 'class_id', 'subject_id',
        'level_id', 'package_id', 'student_package_id',
        'time_id', 'user_id', 'lesson_code',
        'status', 'lesson_date', 'lesson_hour'
    );
    protected $dates = ['deleted_at'];

    public function students()
    {
        return $this->belongsTo('Student','student_id', 'id' );
    }

    public function users()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }

    public function classes()
    {
        return $this->belongsTo('ClassModel', 'class_id', 'id');
    }

    public function subjects()
    {
        return $this->belongsTo('Subject', 'subject_id', 'id');
    }

    public function levels()
    {
        return $this->belongsTo('Level', 'level_id', 'id');
    }
}
