<?php

namespace App\Enum;

use MyCLabs\Enum\Enum;

class Preference extends Enum
{
    private const ALLOW_VISITORS = 'allow-visitors';
    private const ALLOW_USERS    = 'allow-users';
    private const ALLOW_VETS     = 'allow-vets';
}
