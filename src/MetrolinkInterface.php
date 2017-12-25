<?php

namespace ThatDamnQA\MancMetFeed;

/**
 * Gets various Metrolink variables
 **/
interface MetrolinkInterface
{

    function __construct();

    /**
     * Mock the current day
     */
    function setCurrentDay($day);

    /**
     * Mock the current hour
     */
    function setCurrentHour($hour);

    /**
     * Checks peak hours: if it is, then post normal service tweets as well
     * @return bool
     */
    function isPeak();
}
