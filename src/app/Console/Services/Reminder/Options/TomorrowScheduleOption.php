<?php

namespace MKamelMasoud\Ads\Console\Services\Reminder\Options;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use MKamelMasoud\Ads\Notifications\ReminderNotification;
use MKamelMasoud\Ads\Console\Services\Reminder\ReminderServiceInterface;

class TomorrowScheduleOption implements ReminderServiceInterface
{
    public function runService(Collection $users, Carbon $searchDate) : bool
    {
        logger('TomorrowScheduleOption');

        $users->each(function ($user) use ($searchDate) {
            $user->notify(new ReminderNotification("your ads for day {$searchDate->toDateString()} are available"));
        });
        return true;
    }
}
