<?php

namespace LaravelEnso\Holidays\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelEnso\Holidays\Http\Resources\Year;
use LaravelEnso\Holidays\Models\HolidayYear;

class Index extends Controller
{
    public function __invoke(Request $request)
    {
        return ['years' => Year::collection(HolidayYear::get())];
    }
}
