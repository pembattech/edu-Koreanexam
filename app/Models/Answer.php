<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    // Define which attributes can be mass assigned
    protected $fillable = [
        'candidate_id',
        'question_num',
        'answer',
        'is_correct',
        'set',
        'exam_start_time'
    ];

    /**
     * Define a relationship with the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }

    // Define the relationship with ExamQuestion
    public function examQuestion()
    {
        return $this->belongsTo(ExamQuestion::class, 'question_num', 'question_number');
    }

}
