<?php

namespace ThatDamnQA\MancMetFeedTest\Stubs;

use ThatDamnQA\MancMetFeed\WebsiteHandlerInterface;

/**
 * Handle the Metrolink website
 **/
class WebsiteHandler implements WebsiteHandlerInterface
{
    /**
     * @var string API url
     */
    private $url;

    /**
     * WebsiteHandler constructor.
     *
     * @param $url string API url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    public function getMetrolinkStatus()
    {
        switch ($this->url) {
            case 'MINOR_DELAYS':
                return json_decode('
                    {
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
                    }
                ');
            case 'GOOD_SERVICE':
                return json_decode('
                    {
                        "retrievalDate": "22:32:30",
                        "items": 
                        [
                            {
                                "name": "All lines",
                                "severity": "success",
                                "status": "Good service"
                            }
                        ]
                    }
                ');
        }
    }
}
