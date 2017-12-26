<?php
use PHPUnit\Framework\TestCase;
require_once('config/config.dist.php');
require_once 'class/metrolink.class.php';
require_once 'class/status.class.php';
require_once 'class/promises/websitehandler.interface.php';

/**
 * @covers Metrolink
 */
final class StatusTest extends TestCase
{
    public function setUp() {
    }

    /** @dataProvider getStatusStringsProvider */
    public function testGetStatusString($datetime, $expected, $json)
    {
        $website = $this->createMock(WebsiteHandlerInterface::class);
        $website->method('getMetrolinkStatus')->willReturn($json);

        $metrolink = new Metrolink($datetime);
        $s = new Status($website, $metrolink);
        $this->assertEquals($expected, $s->getStatusString());
    }

    public function getStatusStringsProvider()
    {
        return [
            'Good Service on all lines, non-peak' => [
                new DateTimeImmutable('Monday 13:00'),
                '',
                $this->getGoodServiceData(),
            ],
            'Good service on all lines, peak' => [
                new DateTimeImmutable('Monday 9:00'),
                '9:00 — Good service on all lines',
                $this->getGoodServiceData(),
            ],
            'Minor delays, non-peak' => [
                new DateTimeImmutable('Monday 13:00'),
                "Minor delays on East Didsbury line\nMinor delays on Rochdale via Oldham line\nGood service on all other lines",
                $this->getMinorDelaysData(),
            ],
            'Minor delays, peak' => [
                new DateTimeImmutable('Monday 17:00'),
                "17:00 — Minor delays on East Didsbury line\nMinor delays on Rochdale via Oldham line\nGood service on all other lines",
                $this->getMinorDelaysData(),
            ],
        ];
    }

    private function getMinorDelaysData()
    {
        return json_decode('{
            "retrievalDate": "22:32:30",
            "items": 
            [
                {
                    "detail": "<p>Due to an act of vandalism we are currently experiencing minor delays on the East Didsbury line.</p><p>Services travelling in both directions between East Didsbury and Deansgate-Castlefield are affected.</p><p>This is due to earlier Anti-social behaviour at East Didsbury.</p><p>Metrolink apologises for any inconvenience this may cause.</p>",
                    "id": 4,
                    "name": "East Didsbury",
                    "severity": "warning",
                    "status": "Minor delays"
                },
                {
                    "detail": "<p>Due to an act of vandalism we are currently experiencing minor delays on the Rochdale via Oldham line.</p><p>Services travelling in both directions between Victoria and Rochdale Town Centre are affected.</p><p>Metrolink apologises for any inconvenience this may cause.</p>",
                    "id": 8,
                    "name": "Rochdale via Oldham",
                    "severity": "warning",
                    "status": "Minor delays"
                },
                {
                    "name": "Other lines",
                    "severity": "success",
                    "status": "Good service"
                }
            ]
        }');
    }

    private function getGoodServiceData()
    {
        return json_decode('{
            "retrievalDate": "22:32:30",
            "items": 
            [
                {
                    "name": "All lines",
                    "severity": "success",
                    "status": "Good service"
                }
            ]
        }');
    }
}
