<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{

    protected $fillable = [
        'set',
        'question_number',
        'heading',
        'question_type',
        'question',
        'answer_type',
        'option1',
        'option2',
        'option3',
        'option4',
        'correct_answer',
    ];
    
    // public function answers()
    // {
    //     return $this->hasMany(Answer::class);
    // }

//     public function answers()
// {
//     return $this->hasMany(Answer::class, 'question_num', 'question_number');
// }

}
