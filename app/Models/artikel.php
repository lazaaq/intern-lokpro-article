<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class artikel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function jobseeker_detail() {
        return $this->hasOne(JobseekerDetail::class, 'user_id', 'jobseeker_id');
    }
}
