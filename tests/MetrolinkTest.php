<?php

namespace ThatDamnQA\MancMetFeedTest;

use PHPUnit\Framework\TestCase;
use ThatDamnQA\MancMetFeed\Metrolink;

/**
 * @covers \ThatDamnQA\MancMetFeed\Metrolink
 */
final class MetrolinkTest extends TestCase
{
    private $metrolink;

    public function setUp() {
        $this->metrolink = new Metrolink();
    }
    public function testIsPeak()
    {
        // Not peak 4pm Monday
        $this->metrolink->setCurrentHour('16');
        $this->metrolink->setCurrentDay('1'); //Monday
        $this->assertEquals($this->metrolink->isPeak(), false, "4pm should not be peak");

        // IS peak 5pm Monday
        $this->metrolink->setCurrentHour('17');
        $this->metrolink->setCurrentDay('1'); //Monday
        $this->assertEquals($this->metrolink->isPeak(), true, "5pm SHOULD be peak");

        // Not peak on Saturday 4pm
        $this->metrolink->setCurrentHour('16');
        $this->metrolink->setCurrentDay('6'); //Saturday
        $this->assertEquals($this->metrolink->isPeak(), false, "4pm weekends should not be peak");

        // Not peak on Saturday 5pm
        $this->metrolink->setCurrentHour('17');
        $this->metrolink->setCurrentDay('6'); //Saturday
        $this->assertEquals($this->metrolink->isPeak(), false, "5pm weekends should not be peak");
    }
}
