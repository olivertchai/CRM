<?php

namespace Core\Debug;

class Debbuger
{
    public static function dd(): void
    {
        var_dump(func_get_args());
        exit();
    }
}
