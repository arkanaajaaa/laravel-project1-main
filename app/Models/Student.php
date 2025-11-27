<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'classroom_id',
        'address',
        'phone',
        'gender',
        'date_of_birth',
    ];

    protected $with = ['classroom'];

     public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
}
