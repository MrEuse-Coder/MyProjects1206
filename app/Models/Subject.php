<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = [];
    //
    public function courseCode(): Attribute{
        return Attribute::make(
            set: fn($value) => strtoupper($value)
        );

    }

    public function preRequisite(): Attribute{
        return Attribute::make(
            set: fn($value) => strtoupper($value)
        );

    }

    public function descriptiveTitle(): Attribute{
        return Attribute::make(
          set: fn($value) => ucwords(strtolower($value))
        );
    }

    public function students(){
        return $this->belongsToMany(Student::class, 'grades')
            ->withPivot('midterm', 'final')
            ->withTimestamps();
    }

    public function grades(){
        return $this->hasMany(Grade::class);
    }
}
