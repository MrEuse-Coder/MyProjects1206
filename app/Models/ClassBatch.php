<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ClassBatch extends Model
{
    //
    protected $guarded = [];

    protected function batchName(): Attribute
    {
        return Attribute::make(
            set: fn($value) => strtoupper($value)
        );

    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function students(){
        return $this->hasMany(Student::class);
    }
}
