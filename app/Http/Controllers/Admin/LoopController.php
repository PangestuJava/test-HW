<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\LoopService;

class LoopController extends Controller
{
    private $loopService;

    public function __construct(loopService $loopService)
    {
        $this->loopService = $loopService;
    }

    public function printNumbers()
    {
        $result = [];

        for ($i = 1; $i <= 100; $i++) {
            $result[] = $this->loopService->processNumber($i);
        }

        return response()->json(['result' => $result]);
    }
}
