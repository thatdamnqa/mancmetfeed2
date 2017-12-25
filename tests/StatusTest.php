<?php

namespace ThatDamnQA\MancMetFeedTest;

use PHPUnit\Framework\TestCase;
use ThatDamnQA\MancMetFeed\Metrolink;
use ThatDamnQA\MancMetFeed\Status;
use ThatDamnQA\MancMetFeedTest\Stubs\WebsiteHandler as WebsiteHandlerStub;

/**
 * @covers Metrolink
 */
final class StatusTest extends TestCase
{
    public function setUp() {
    }

    public function testGetStatusString()
    {
        $metrolink = new Metrolink();
        $metrolink->setCurrentDay(1);

        $websiteHandler = new WebsiteHandlerStub('GOOD_SERVICE');
        $metrolink->setCurrentHour(13);
        $s = new Status($websiteHandler, $metrolink);
        $this->assertEquals('', $s->getStatusString(), "Good service on all lines, non-peak");

        $websiteHandler = new WebsiteHandlerStub('GOOD_SERVICE');
        $metrolink->setCurrentHour(9);
        $s = new Status($websiteHandler, $metrolink);
        $this->assertEquals('9:00 — Good service on all lines', $s->getStatusString(), "Good service on all lines, peak");


        $websiteHandler = new WebsiteHandlerStub('MINOR_DELAYS');
        $metrolink->setCurrentHour(13);
        $s = new Status($websiteHandler, $metrolink);
        $this->assertEquals("Minor delays on East Didsbury line\nMinor delays on Rochdale via Oldham line\nGood service on all other lines",
            $s->getStatusString(), "Minor delays, non-peak");

        $websiteHandler = new WebsiteHandlerStub('MINOR_DELAYS');
        $metrolink->setCurrentHour(17);
        $s = new Status($websiteHandler, $metrolink);
        $this->assertEquals("17:00 — Minor delays on East Didsbury line\nMinor delays on Rochdale via Oldham line\nGood service on all other lines",
            $s->getStatusString(), "Minor delays, peak");    }
}
