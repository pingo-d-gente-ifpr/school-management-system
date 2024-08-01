<?php

namespace App\Enums;

enum Gender: string
{
    case feminino = 'femino';
    case masculino = 'masculino';
    case outro = 'outro';


    public function name(): string
    {
        return match ($this) {
            self::feminino => __('Feminino'),
            self::masculino => __('Masculino'),
            self::outro => __('Outro'),
        };
    }
}
