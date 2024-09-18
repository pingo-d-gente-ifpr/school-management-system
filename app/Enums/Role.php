<?php

namespace App\Enums;

enum Role: string
{
    case admin = 'admin';
    case teacher = 'teacher';
    case parents = 'parents';

    public function name(): string
    {
        return match ($this) {
            self::admin => __('Admin'),
            self::teacher => __('Professor(a)'),
            self::parents => __('Responsável'),
        };
    }
}