<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $guarded = [];

    public function class_batch(){
        return $this->belongsTo(ClassBatch::class);
    }

    public function subjects(){
        return $this->belongsToMany(Subject::class,'grades')
            ->withPivot('midterm', 'final')
            ->withTimestamps();
    }

    public function grades(){
        return $this->hasMany(Grade::class);
    }
}
