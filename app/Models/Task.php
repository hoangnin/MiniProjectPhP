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
        'due_date',
        'project_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
