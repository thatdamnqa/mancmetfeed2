<?php
use PHPUnit\Framework\TestCase;
require_once 'class/promises/websitehandler.interface.php';

/**
 * Handle the Metrolink website
 **/
class WebsiteHandlerStub implements WebsiteHandlerInterface
{
    /**
     * Scrape a string from a given URL
     * @param $url URL to scrape
     * @param $xpath XPath of string to return
     * @return string
     */
    public function getXPathContent($url, $xpath)
    {

    }
}
