<?php

namespace MKamelMasoud\Ads\Console\Services\Reminder;

use Carbon\Carbon;
use App\Models\User;
use MKamelMasoud\Ads\Console\Services\Reminder\ReminderServiceInterface;

class ReminderService
{
    protected $service;

    protected $searchDate;

    public function __construct(ReminderServiceInterface $service, Carbon $searchDate)
    {
        $this->setService($service);
        $this->setSearchDate($searchDate);
    }

    public function process()
    {
        $this->getService()->runService(
            $this->getUsers(),
            $this->getSearchDate()
        );
    }

    public function getUsers()
    {
        return User::whereHas('ads', function ($q) {
            return $q
                    ->whereMonth('ads.start_date', $this->getSearchDate()->month)
                    ->whereDay('ads.start_date', $this->getSearchDate()->day)
            ;
        })->get();
    }

    /**
     * Get the value of Service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set the value of Service
     *
     * @return  self
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get the value of searchDate
     */
    public function getSearchDate()
    {
        return $this->searchDate;
    }

    /**
     * Set the value of searchDate
     *
     * @return  self
     */
    public function setSearchDate($searchDate)
    {
        $this->searchDate = $searchDate;

        return $this;
    }
}
