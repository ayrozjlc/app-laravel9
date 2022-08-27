<?php

namespace App\Utilities\Traits;

/**
 *
 */
trait EnumList
{
    public function list()
    {
        $list = [];
        $names = self::cases();

        foreach ($names as $n) {
            $list[] = $n->name;
        }

        return $list;
    }
}
