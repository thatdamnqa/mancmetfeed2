<?php
use PHPUnit\Framework\TestCase;
require_once('config/config.dist.php');
require_once 'class/metrolink.class.php';
require_once 'class/status.class.php';
require_once 'class/promises/websitehandler.interface.php';
require_once 'unittests/dataproviders/status.dataprovider.php';

/**
 * @covers Metrolink
 */
final class StatusTest extends TestCase
{
    public function setUp() {
    }

    /** @dataProvider Dataprovider\Status::getStatusStringsProvider */
    public function testGetStatusString($datetime, $expected, $json)
    {
        $website = $this->createMock(WebsiteHandlerInterface::class);
        $website->method('getMetrolinkStatus')->willReturn($json);

        $metrolink = new Metrolink($datetime);
        $s = new Status($website, $metrolink);
        $this->assertEquals($expected, $s->getStatusString());
    }
}
