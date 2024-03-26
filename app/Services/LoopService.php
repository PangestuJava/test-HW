<?php

namespace App\Services;

/**
 * Class LoopService.
 */
class LoopService
{
    public static function processNumber($number)
    {
        if ($number % 3 == 0 && $number % 5 == 0) {
            return "TigaLima";
        } elseif ($number % 3 == 0) {
            return "Tiga";
        } elseif ($number % 5 == 0) {
            return "Lima";
        } else {
            return $number;
        }
    }
}
