<?php

namespace App\Enums;

enum Gender: int
{
    case Feminino = 1;
    case Masculino = 2;
    case Outro = 3;


    public function name(): string
    {
        return match ($this) {
            self::Feminino => __('Feminino'),
            self::Masculino => __('Masculino'),
            self::Outro => __('Outro'),
        };
    }
}
