<?php

namespace LaravelEnso\Holidays\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use LaravelEnso\Holidays\Http\Resources\Holiday;
use LaravelEnso\Holidays\Models\HolidayYear;

class Show extends Controller
{
    public function __invoke(Request $request, HolidayYear $year)
    {
        return [
            'holidays' => Holiday::collection($year->holidays()->orderBy('date')->get()),
            'months' => Collection::range(1, 12)->map(fn ($month) => [
                'id' => $month,
                'name' => Carbon::create()->month($month)->format('F'),
            ]),
        ];
    }
}
