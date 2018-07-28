<?php

namespace App\Enum;

use MyCLabs\Enum\Enum;

class Preference extends Enum
{
    public const ALLOW_VISITORS = 0;
    public const ALLOW_USERS    = 1;
    public const ALLOW_VETS     = 2;
}
