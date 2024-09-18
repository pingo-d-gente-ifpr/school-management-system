<?php

namespace App\Enums;

enum Stage: string
{
    case maternal = 'maternal';
    case gardenI = 'garden I';
    case gardenII = 'garden II';
    case gardenIII = 'garden III';


    public function name(): string
    {
        return match ($this) {
            self::maternal => __('Maternal'),
            self::gardenI => __('Jardim I'),
            self::gardenII => __('Jardim II'),
            self::gardenIII => __('Jardim III'),
        };
    }
}
