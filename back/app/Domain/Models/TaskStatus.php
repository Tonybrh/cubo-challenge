<?php

namespace App\Domain\Models;

use Database\Factories\TaskStatusFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    protected static function newFactory(): TaskStatusFactory
    {
        return TaskStatusFactory::new();
    }
}
