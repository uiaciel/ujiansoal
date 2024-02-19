<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function soal()
    {
        return $this->belongsTo('App\Models\Soal', 'soal_id');
    }

    public function tanggal()
    {
        return Carbon::parse($this->created_at)->isoFormat('D MMMM YYYY');
    }


}
