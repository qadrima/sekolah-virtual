<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectComment extends Model
{
    protected $fillable = [
        'user_id',
        'subject_id',
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
