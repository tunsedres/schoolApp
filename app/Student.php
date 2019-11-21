<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'surname', 'code', 'student_number', 'user_id'];

    protected function setCodeAttribute($value)
    {
        $this->attributes['code'] = rand(1000, 9999). '-'. $this->student_number. '-'. date('dmy');
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
