<?php

namespace LaravelEnso\Holidays\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelEnso\Holidays\Http\Resources\Holiday;
use LaravelEnso\Holidays\Models\HolidayYear;

class Show extends Controller
{
    public function __invoke(Request $request, HolidayYear $holidayYear)
    {
        return Holiday::collection($holidayYear->holidays);
    }
}
