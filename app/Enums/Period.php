<?php

namespace App\Enums;

enum Period: string
{
    case morning = 'morning';
    case afternoon = 'afternoon';
    case fulltime = 'full_time';


    public function name(): string
    {
        return match ($this) {
            self::morning => __('Matutino'),
            self::afternoon => __('Vespertino'),
            self::fulltime => __('Integral'),
        };
    }
}
