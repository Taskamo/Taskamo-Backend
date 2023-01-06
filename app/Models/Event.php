<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create()
 */
class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'user_id',
    ];
}
