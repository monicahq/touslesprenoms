<?php

namespace App\Helpers;

use App\Models\MultiAvatar;

class NameHelper
{
    public static function getAvatar(string $name): string
    {
        $multiavatar = new MultiAvatar;
        $avatar = $multiavatar($name, null, null);

        return $avatar;
    }
}
