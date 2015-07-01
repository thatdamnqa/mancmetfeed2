<?php

/**
  * Gets various Metrolink variables
  **/
class Metrolink
{
    /**
     * Checks peak hours: if it is, then post normal service tweets as well
     * @return bool
     */
    public function isPeak()
    {
        // Always off-peak during weekends
        if (date('N') == 6 || date('N') == 7) return false;

        $date = date('H');
        if ($date >= 6 && $date <= 10) return true;
        if ($date >= 17 && $date <= 19) return true;
        return false;
    }
}