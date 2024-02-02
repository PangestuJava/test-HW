<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoopController extends Controller
{
    public function printNumbers()
    {
        $result = [];

        for ($i = 1; $i <= 100; $i++) {
            if ($i % 3 == 0 && $i % 5 == 0) {
                $result[] = "TigaLima";
            } elseif ($i % 3 == 0) {
                $result[] = "Tiga";
            } elseif ($i % 5 == 0) {
                $result[] = "Lima";
            } else {
                $result[] = $i;
            }
        }

        return response()->json(['result' => $result]);
    }
}
