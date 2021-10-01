<?php


namespace Lakm\Contact\Models;


use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    protected $fillable = ['subject', 'message'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}