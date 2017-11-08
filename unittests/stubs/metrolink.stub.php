<?php
require_once 'class/promises/websitehandler.interface.php';

/**
 * Gets various Metrolink variables
 **/
class MetrolinkStub
{

    function __construct()
    {

    }

    /**
     * Mock the current day
     */
    function set_current_day($day)
    {

    }

    /**
     * Mock the current hour
     */
    function set_current_hour($hour)
    {

    }

    /**
     * Checks peak hours: if it is, then post normal service tweets as well
     * @return bool
     */
    function isPeak(){

    }
}