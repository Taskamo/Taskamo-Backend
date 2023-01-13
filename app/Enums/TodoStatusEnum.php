<?php

namespace App\Enums;

enum TodoStatusEnum: string
{
    case TODO = 'todo';
    case DOING = 'doing';
    case DONE = 'done';
}
