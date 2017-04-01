<?php

/**
  * Gets various Metrolink variables
  **/
class Metrolink
{
    /**
      * The current server time day
      */
    private $current_day;

    /**
      * The current server time hour
      */
    private $current_hour;


    public function __construct() {
        $this->set_current_hour(date('H'));
        $this->set_current_day(date('N'));
    }

    /**
      * Mock the current day
      */
    public function set_current_day($day) {
        $this->current_day = $day;
    }

    /**
      * Mock the current hour
      */
    public function set_current_hour($hour) {
        $this->current_hour = $hour;
    }

    /**
     * Checks peak hours: if it is, then post normal service tweets as well
     * @return bool
     */
    public function isPeak()
    {
        // Always off-peak during weekends
        if ($this->current_day == 6 || $this->current_day == 7) return false;

        if ($this->current_hour >= 6 && $this->current_hour <= 10) return true;
        if ($this->current_hour >= 17 && $this->current_hour <= 19) return true;
        return false;
    }
}