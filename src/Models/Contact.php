<?php


namespace Lakm\Contact\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Contact extends Model
{
    use Notifiable;

    public $guarded = [];

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    protected $casts = [
        'created_at' => 'datetime: Y-m-d H:i:s'
    ];
}