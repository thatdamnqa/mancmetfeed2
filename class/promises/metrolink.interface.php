<?php

/**
 * Gets various Metrolink variables
 **/
interface MetrolinkInterface
{

    function __construct(DateTimeInterface $datetime);

    /**
     * Checks peak hours: if it is, then post normal service tweets as well
     * @return bool
     */
    function isPeak();
}
