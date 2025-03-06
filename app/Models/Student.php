<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Student extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'profile_picture',
        'name',
        'dob',
        'gender',
        'address',
        'contact_number',
        'email',
        'present_qualification',
        'father_name',
        'mother_name',
        'profession',
        'parents_phone_number',
        'enrollment_date',
        'total_amount_to_pay',
        'is_korean',
        'password'
    ];

    //   // Define the relationship to the Course model
    //   public function courses()
    //   {
    //       return $this->hasMany(Course::class, 'student_id');
    //   }

    public function payments()
    {
        return $this->hasMany(StudentPayment::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
