<?php

namespace App\Models;

use App\Enums\TodoStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
    ];

    protected $casts = [
        'status' => TodoStatusEnum::class
    ];

    protected $dates = ['deleted_at'];
}
