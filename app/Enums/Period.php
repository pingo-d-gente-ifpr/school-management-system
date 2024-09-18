<?php

namespace App\Enums;

enum Period: string
{
    case fulltime = 'fulltime';
    case morning = 'morning';
    case afternoon = 'afternoon';
    


    public function name(): string
    {
        return match ($this) {
            self::morning => __('Matutino'),
            self::afternoon => __('Vespertino'),
            self::fulltime => __('Integral'),
        };
    }
}
