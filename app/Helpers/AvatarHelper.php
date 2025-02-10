<?php

namespace App\Helpers;

class AvatarHelper
{
    public static function generateAvatarUrl($name, $size = 32, $rounded = true, $color = 'fff', $background = '7839CD')
    {
        return "https://ui-avatars.com/api/?name=" . urlencode($name) . "&size=" . $size . "&rounded=" . ($rounded ? 'true' : 'false') . "&color=" . $color . "&background=" . $background;
    }
}
