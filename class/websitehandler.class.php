<?php
require_once 'promises/websitehandler.interface.php';

/**
  * Handle the Metrolink website
  **/
class WebsiteHandler implements WebsiteHandlerInterface
{
    /**
     * @var string Cached data from the API
     */
    private $html;

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

    /**
     * Load a URL and return HTML contents
     * @param $url
     * @return string
     */
    private function getFromUrl()
    {
        // Simple caching
        if ($this->html != null) return $this->html; 
        
        $handle = fopen($this->url, "rb");
        $contents = stream_get_contents($handle);
        fclose($handle);

        $this->html = $contents;
        return $contents;
    }

    /**
     * @return array Array of the Metrolink status info
     * @throws Exception Throws exception if the API is down
     */
    public function getMetrolinkStatus()
    {
        $json = $this->getFromUrl($this->url);
        $decoded_json = json_decode($json);

        if ('' == $json || null == $decoded_json) {
            throw new Exception("API is not working");
        }

        return $decoded_json;
    }
}
