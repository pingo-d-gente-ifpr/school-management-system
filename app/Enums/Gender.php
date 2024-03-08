<?php

namespace App\Enums;

enum Gender: int
{
    case Female = 1;
    case Male = 2;
    case Other = 3;


    public function name(): string
    {
        return match ($this) {
            self::Female => __('Feminino'),
            self::Male => __('Masculino'),
            self::Other => __('Outro'),
        };
    }
}
