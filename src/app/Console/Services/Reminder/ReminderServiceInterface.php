<?php

namespace MKamelMasoud\Ads\Console\Services\Reminder;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

interface ReminderServiceInterface
{
    public function runService(Collection $users, Carbon $searchDate) : bool;
}
