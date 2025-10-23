<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoteBook extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
