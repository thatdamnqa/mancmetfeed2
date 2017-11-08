<?php

/**
 * Handle the Metrolink website
 **/
interface WebsiteHandlerInterface
{
    /**
     * Scrape a string from a given URL
     * @param $url URL to scrape
     * @param $xpath XPath of string to return
     * @return string
     */
    function getXPathContent($url, $xpath);
}
