<?php

namespace Core\Debug;

class Debbuger
{
    public static function dd()
    {
        var_dump(func_get_args());
        exit();
    }
}
