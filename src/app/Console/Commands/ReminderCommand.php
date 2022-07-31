<?php

namespace MKamelMasoud\Ads\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use MKamelMasoud\Ads\Console\Services\Reminder\ReminderService;
use MKamelMasoud\Ads\Console\Services\Reminder\Options\TomorrowScheduleOption;

class ReminderCommand extends Command
{
    private $type;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command for scheduling sending reminder for advertiser';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        logger('reminder opened');

        $this->setType($this->argument('type'));
        $searchDate = Carbon::today();

        switch ($this->getType()) {
            case 'daily':
                $searchDate = $searchDate->addDays(1);
                (new ReminderService(new TomorrowScheduleOption(), $searchDate))->process();
                break;
            case 'weekly':
                break;
        }
    }

    /**
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
