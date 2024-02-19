<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pertanyaan()
    {
        return $this->hasMany('App\Models\Pertanyaan', 'soal_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }


}
