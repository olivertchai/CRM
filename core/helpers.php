<?php

use Core\Debug\Debugger;

if (!function_exists('dd')) {
    function dd(): void
    {
        Debugger::dd(...func_get_args());
    }
}
