<?php

namespace LaravelEnso\Holidays\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelEnso\Holidays\Models\Holiday;

class Toggle extends Controller
{
    public function __invoke(Request $request, Holiday $holiday)
    {
        $holiday->update([
         'is_working_day' => ! $holiday->is_working_day,
        ]);

        return $holiday;
    }
}
