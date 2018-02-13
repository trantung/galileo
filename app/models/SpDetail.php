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
        'student_id', 'class_id', 'subject_id',
        'level_id', 'package_id', 'student_package_id',
        'time_id', 'user_id', 'lesson_code',
        'status', 'lesson_date'
    );
    protected $dates = ['deleted_at'];

}
