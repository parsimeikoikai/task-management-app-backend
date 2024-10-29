<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $connection = 'pgsql';
    protected $fillable = [
        'title',
        'description',
        'status',
        'due_date',
    ];
}


