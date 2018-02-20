<?php
namespace Thatdamnqa\MancMetFeedTest\DataProvider;

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

    private static function getSevereIssueData()
    {
        return json_decode('{
"retrievalDate": "01:10:30",
"items": [
{
"detail": "<p>Due to an overhead line fault in the Deansgate Castlefield area services are currently operating Altrincham to Cornbrook only. Tickets and Passes are being accepted on Northern Rail Services between Altrincham and Piccadilly and the 263 Bus Service between Altrincham and the City Centre. Tickets and passes are also being accepted on any Stagecoach Bus Service operating on Metrolink corridors ONLY.</p>",
"id": 1,
"name": "Altrincham",
"severity": "warning",
"status": "Service change"
},
{
"detail": "<p>Due to an overhead line fault services are operating between Ashton and Piccadilly Station. Tickets and passes are being accepted on any Stagecoach service operating on Metrolink corridors ONLY.</p>",
"id": 2,
"name": "Ashton-under-Lyne",
"severity": "warning",
"status": "Service change"
},
{
"detail": "<p>Due to an overhead line incident, the Bury line is currently suspended.</p><p>Passengers can use their tickets on the 42, 135, 97 and 98 and 524 bus services. Tram services will terminate at Queens Road. Tickets and passes are also being accepted on a full replacement bus service between Victoria and Bury calling at all station stops.</p><p>Metrolink apologises for any inconvenience this may cause.</p>",
"id": 3,
"name": "Bury",
"severity": "danger",
"status": "Suspended"
},
{
"detail": "<p>Due to an overhead line fault in the Deansgate Castlefield area services are operating between East Didsbury and Cornbrook. Tickets and passes are being accepted on Northern Rail services between East Didsbury and Manchester Piccadilly. Also tickets and passes are being accepted on any Stagecoach serviceoperating on Metrolink corridors ONLY.</p>",
"id": 4,
"name": "East Didsbury",
"severity": "warning",
"status": "Service change"
},
{
"detail": "<p>Due to an overhead line fault in the Deansgate-Castlefield area services are operating between Eccles and Cornbrook. Tickets and passes are being accepted on any Stagecoach bus service. Tickets and passes are being accepted also on the First service 33 and with Northern Rail between Victoria and Eccles.</p>",
"id": 5,
"name": "Eccles via MediaCityUK",
"severity": "warning",
"status": "Service change"
},
{
"detail": "<p>Due to an overhead line fault in the Deansgate-Castlefield area services are operating between Manchester Airport and Firswood. Tickets and passes are being accepted on Northern Rail services betweenManchester Airport and Manchester Piccadilly. Tickets and passes are also being accepted on all Stagecoach Services operating on Metrolink corridors ONLY.</p>",
"id": 6,
"name": "Manchester Airport",
"severity": "warning",
"status": "Service change"
},
{
"detail": "<p>Due to an overhead line fault at Deansgate Castlefield services are operating between Rochdale and Exchange Square. Tickets and passes are being accepted on all Stagecoach bus services operating on Metrolink corridors ONLY.</p>",
"id": 8,
"name": "Rochdale via Oldham",
"severity": "warning",
"status": "Service change"
},
{
"name": "Other lines",
"severity": "success",
"status": "Good service"
}
]
}
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