<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'department_id',
        'name',
        'position',
        'salary',
        'joined_at',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}