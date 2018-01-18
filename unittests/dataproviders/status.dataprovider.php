<?php
namespace Dataprovider;

class Status {
    public static function getStatusStringsProvider()
    {
        return [
            'Good Service on all lines, non-peak' => [
                new \DateTimeImmutable('Monday 13:00'),
                '',
                self::getGoodServiceData(),
            ],
            'Good service on all lines, peak' => [
                new \DateTimeImmutable('Monday 9:00'),
                '9:00 — Good service on all lines',
                self::getGoodServiceData(),
            ],
            'Minor delays, non-peak' => [
                new \DateTimeImmutable('Monday 13:00'),
                "Minor delays on East Didsbury line\nMinor delays on Rochdale via Oldham line\nGood service on all other lines",
                self::getMinorDelaysData(),
            ],
            'Minor delays, peak' => [
                new \DateTimeImmutable('Monday 17:00'),
                "17:00 — Minor delays on East Didsbury line\nMinor delays on Rochdale via Oldham line\nGood service on all other lines",
                self::getMinorDelaysData(),
            ],
        ];
    }

    private static function getMinorDelaysData()
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

    private static function getGoodServiceData()
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