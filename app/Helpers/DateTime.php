<?php

namespace App\Helpers;


use Illuminate\Support\Carbon;

class DateTime
{
    public static function getCurrentWeekDatesArray(): array
    {
        $day_start = Carbon::now()->startOfWeek();
        $day_end = Carbon::now()->endOfWeek();
        $week = [];
        while ( $day_start->lte($day_end)) {
            $week[] = $day_start->toDateString();
            $day_start->addDay();
        }

        return $week;
    }
}
