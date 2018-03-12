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

}
