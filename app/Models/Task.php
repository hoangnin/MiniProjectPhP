<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $casts = [
        'due_date' => 'date',
    ];

    protected $fillable=[
        'title',
        'description',
        'status',
        'user_id',
        'due_date'
    ];
}
