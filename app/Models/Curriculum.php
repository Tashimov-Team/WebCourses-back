<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curriculum extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'course_id',
        'duration',
        'themes'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
