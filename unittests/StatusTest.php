<?php
use PHPUnit\Framework\TestCase;
require_once('config/config.php');
require_once 'class/status.class.php';
require_once 'unittests/stubs/websitehandler.stub.php';
require_once 'unittests/stubs/metrolink.stub.php';


/**
 * @covers Metrolink
 */
final class StatusTest extends TestCase
{
    private $status;
    private $websiteHandler;

    public function setUp() {
        //$websiteHandler = new WebsiteHandlerStub();
        $this->websiteHandler = $this->createMock(WebsiteHandlerStub::class);
        $metrolink = new MetrolinkStub();
        $this->status = new Status($this->websiteHandler, $metrolink);
    }

    public function testGetStatusString()
    {

        $this->websiteHandler->method('getXPathContent')
            ->will($this->onConsecutiveCalls(
                ['Altrincham', "Ashton-under-Lyne", "Bury", "City Zone", "East Didsbury", "Eccles via MediaCityUK", "Manchester Airport", "Rochdale via Oldham"],
                ['Good Service', 'Good Service', 'Good Service', 'Good Service', 'Good Srvice', 'Good Service', 'Good Service', 'Good Service']
            ));

        $this->assertEquals('', $this->status->getStatusString(), "Good service on all lines, non-peak");
    }
}
