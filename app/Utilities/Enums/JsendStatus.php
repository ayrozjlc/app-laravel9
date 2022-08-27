<?php

namespace App\Utilities\Enums;

use App\Utilities\Traits\EnumList;
use Exception;

enum JsendStatus
{
    use EnumList;

    case success;
    case fail;
    case error;
    case warning;

    public function valid($status)
    {
        $valid = false;
        $list = $this->list();

        if (in_array($status, $list)) {
            $valid = true;
        } else {
            $msg = __('exceptions.2', ['statusList' => implode(', ', $list)]);
            throw new Exception($msg, 2);
        }

        return $valid;
    }
}
