<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class QuantityDownload extends Eloquent {

	//use SoftDeletingTrait;
    //protected $dates = ['deleted_at'];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'quantity_downloads';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $fillable = array('role_id', 'max_account','max_document', 'start_time',
		'end_time', 'level_id', 'class_id', 'subject_id');
	
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
