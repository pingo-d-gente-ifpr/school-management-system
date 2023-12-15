<?php

namespace App\Enums;

enum Role: int
{
    case Admin = 1;
    case Teacher = 2;
    case Parents = 3;
    case Student = 4;

    public function name(): string
    {
        return match ($this) {
            self::Admin => __('Admin'),
            self::Teacher => __('Teacher'),
            self::Parents => __('Parents'),
            self::Student => __('Student'),
        };
    }
}