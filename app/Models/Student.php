<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['user_id', 'student_number', 'name', 'email', 'phone'];

    public function user() { return $this->belongsTo(User::class); }
    public function registrations() { return $this->hasMany(Registration::class); }
    public function courses() { return $this->belongsToMany(Course::class, 'registrations')->withTimestamps(); }
}
