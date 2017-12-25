<?php

namespace ThatDamnQA\MancMetFeed;

/**
  * Gets various Metrolink variables
  **/
class Metrolink implements MetrolinkInterface
{
    /**
      * The current server time day
      */
    private $currentDay;

    /**
      * The current server time hour
      */
    private $currentHour;


    public function __construct() {
        $this->setCurrentHour(date('H'));
        $this->setCurrentDay(date('N'));
    }

    /**
      * Mock the current day
      */
    public function setCurrentDay($day) {
        $this->currentDay = $day;
    }

    /**
      * Mock the current hour
      */
    public function setCurrentHour($hour) {
        $this->currentHour = $hour;
    }

    public function getCurrentHour() {
        return $this->currentHour;
    }

    /**
     * Checks peak hours: if it is, then post normal service tweets as well
     * @return bool
     */
    public function isPeak()
    {
        // Always off-peak during weekends
        if ($this->currentDay == 6 || $this->currentDay == 7) return false;

        if ($this->currentHour >= 6 && $this->currentHour <= 10) return true;
        if ($this->currentHour >= 17 && $this->currentHour <= 19) return true;
        return false;
    }
}
