<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class DocumentVersion extends Eloquent
{
    use SoftDeletingTrait;
    public $timestamps = true;
    
    protected $table = 'document_verisons';
    protected $fillable = ['name', 'code', 'status', 'document_id', 'url'];
    protected $dates = ['deleted_at'];

}