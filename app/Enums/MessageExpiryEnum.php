<?php

namespace App\Enums;

enum MessageExpiryEnum: string
{
    case Once = 'once';
    case Day = 'day';
}
