<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class StudentPackage extends Eloquent {

    use SoftDeletingTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'student_package';
    public $timestamps = true;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $fillable = array(
        'student_id', 'center_id', 'class_id', 'subject_id',
        'level_id', 'package_id', 'money_paid',
        'time_id', 'lesson_total', 'lesson_code',
        'code'
    );
    protected $dates = ['deleted_at'];

    public function students()
    {
        return $this->belongsTo('Student','student_id', 'id' );
    }

    public function centers()
    {
        return $this->belongsTo('Center','center_id', 'id' );
    }

    public function classes()
    {
        return $this->belongsTo('ClassModel','class_id', 'id' );
    }

    public function subjects()
    {
        return $this->belongsTo('Subject','subject_id', 'id' );
    }

    public function levels()
    {
        return $this->belongsTo('Level','level_id', 'id' );
    }

    public function packages()
    {
        return $this->belongsTo('Package','package_id', 'id' );
    }
}