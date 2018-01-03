<?php

class SubjectClass extends Eloquent
{
	use SoftDeletingTrait;
    protected $table = 'subjects';
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];
}