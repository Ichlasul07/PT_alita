<?php
// app/Models/Location.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name'];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'location_code', 'code');
    }
}
