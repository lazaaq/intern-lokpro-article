<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pelamar()
    {
        return $this->hasMany(Pelamar::class);
    }
}
