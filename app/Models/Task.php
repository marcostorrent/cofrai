<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'start_date', 'end_date', 'frequency', 'day', 'iterations', 'task_group_id', 'is_completed'
    ];

    protected $casts = [
        'is_completed' => 'boolean',
    ];


    public function taskGroup()
    {
        return $this->belongsTo(TaskGroup::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->via('taskGroup');
    }
}
