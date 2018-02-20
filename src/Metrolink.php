<?php
namespace Thatdamnqa\MancMetFeed;

/**
  * Gets various Metrolink variables
  **/
class Metrolink implements MetrolinkInterface
{
    /**
      * The current server time day
      */
    private $now;

    public function __construct(DateTimeInterface $date)
    {
        $this->now = $date;
    }

    public function getCurrentHour() {
        return $this->now->format('G');
    }

    /**
     * Checks peak hours: if it is, then post normal service tweets as well
     * @return bool
     */
    public function isPeak()
    {
        $currentHour = $this->getCurrentHour();
        $currentWeekday = $this->now->format('N');
        // Always off-peak during weekends
        if ($currentWeekday == 6 || $currentWeekday == 7) {
            return false;
        }

        if ($currentHour >= 6 && $currentHour <= 10) {
            return true;
        }
        if ($currentHour >= 17 && $currentHour <= 19) {
            return true;
        }

        return false;
    }
}
