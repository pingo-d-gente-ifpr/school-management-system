<?php

namespace App\Enums;

enum Role: int
{
    case admin = 1;
    case teacher = 2;
    case parents = 3;

    public function name(): string
    {
        return match ($this) {
            self::admin => __('Admin'),
            self::teacher => __('Professor(a)'),
            self::parents => __('Responsável'),
        };
    }
}