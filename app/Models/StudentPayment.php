<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'payment_type',
        'amount',
        'payment_method',
        'payment_date',
        'transaction_id',
        'remarks',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
