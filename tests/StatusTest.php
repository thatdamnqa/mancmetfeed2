<?php
namespace Thatdamnqa\MancMetFeedTest;

use PHPUnit\Framework\TestCase;
use \Thatdamnqa\MancMetFeed\Metrolink;
use Thatdamnqa\MancMetFeed\Status;
use Thatdamnqa\MancMetFeed\WebsiteHandlerInterface;

/**
 * @covers Metrolink
 */
final class StatusTest extends TestCase
{
    public function setUp() {
    }

    /** @dataProvider Thatdamnqa\MancMetFeedTest\DataProvider\Status::getStatusStringsProvider */
    public function testGetStatusString($datetime, $expected, $json)
    {
        $website = $this->createMock(WebsiteHandlerInterface::class);
        $website->method('getMetrolinkStatus')->willReturn($json);

        $metrolink = new Metrolink($datetime);
        $s = new Status($website, $metrolink);
        $this->assertEquals($expected, $s->getStatusString());
    }
}
