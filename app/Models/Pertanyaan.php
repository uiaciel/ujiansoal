<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pilihan()
    {
        return $this->hasMany('App\Models\Jawaban', 'pertanyaan_id');
    }
}
