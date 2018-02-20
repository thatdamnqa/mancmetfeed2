<?php
namespace Thatdamnqa\MancMetFeedTest;

use PHPUnit\Framework\TestCase;
use Thatdamnqa\MancMetFeed\Metrolink;

/**
 * @covers \Thatdamnqa\MancMetFeed\Metrolink
 */
final class MetrolinkTest extends TestCase
{
    /** @dataProvider isPeakProvider */
    public function testIsPeak($datetime, $result)
    {
        $metrolink = new Metrolink($datetime);
        $this->assertEquals($result, $metrolink->isPeak());

    }

    public function isPeakProvider()
    {
        return [
            '4pm should not be peak'  => [new \DateTimeImmutable('2017-12-22 16:00:00'), false],
            '5pm should be peak'      => [new \DateTimeImmutable('2017-12-22 17:00:00'), true],
            '4pm weekend is not peak' => [new \DateTimeImmutable('2017-12-23 16:00:00'), false],
            '5pm weekend is not peak' => [new \DateTimeImmutable('2017-12-23 17:00:00'), false],
        ];
    }
}
