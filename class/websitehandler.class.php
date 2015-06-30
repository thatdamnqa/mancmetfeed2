<?php

/**
  * Handle the Metrolink website
  **/
class WebsiteHandler
{
    private $html;
    
    private function cleanseText($string)
    {
        $string = trim(
            $string,
            " \t\n\r\0\x0B "
        );

        return $string;
    }
    
    
    /**
     * Load a URL and return HTML contents
     * @param $url
     * @return string
     */
    public function getHtml($url)
    {
        if ($this->html != null) return $this->html; 
        
        $handle = fopen($url, "rb");
        $contents = stream_get_contents($handle);
        fclose($handle);

        $this->html = $contents;
        return $contents;
    }


    /**
     * Scrape a string from a given URL
     * @param $url URL to scrape
     * @param $xpath XPath of string to return
     * @return string
     */
    public function getXPathContent($url, $xpath)
    {
        $html = $this->getHtml($url);
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $domxpath = new DOMXPath($dom);

        $tags = $domxpath->query($xpath);

        $returnArray = [];

        if ($tags->length > 0) {
            for ($n=0; $n<$tags->length; $n++) {
                $content = $this->cleanseText($tags->item($n)->textContent);
            
                if ($content != '') {
                    $returnArray[] = $content;
                }
            }
        }

        return $returnArray;
    }
}
