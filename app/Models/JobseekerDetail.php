<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobseekerDetail extends Model
{
    use HasFactory;

    protected $table = "jobseeker_details";

    protected $guarded = ['id'];

    public function jobseeker()
    {
        return $this->belongsTo(User::class, 'jobseeker_id');
    }
}
