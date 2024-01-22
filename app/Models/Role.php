<?php

namespace App\Models;

class Role extends \Spatie\Permission\Models\Role
{
    public static function permissionExtend(mixed $name, &$beforeLastDot, &$afterLastDot): void
    {
        $parts = explode('.', $name);
        $beforeLastDot = implode('.', array_slice($parts, 0, -1));
        $afterLastDot = end($parts);
    }
}
