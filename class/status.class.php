<?php

/**
  * Gets, and parses, the line status.
  **/
class Status
{
    private $websiteHandler;
    private $metrolink;

    public function __construct($websiteHandler, $metrolink)
    {
        $this->websiteHandler = $websiteHandler;
        $this->metrolink = $metrolink;
    }
    
    /**
      * Returns true if all statuses are of a good service
      * (string to watch out for is in config)
      * @param array|string Status: can be either a string or array of strings.
      */
    private function isGoodStatus($status)
    {
        if (!is_array($status)) {
            $status = array($status);
        }

        foreach ($status as $s) {
            if ($s != MMS_GOOD_SERVICE_STRING) {
                return false;
            } 
        }
        
        return true;
    }

    public function getStatusString()
    {
        $lines = $this->websiteHandler->getXPathContent(
            MMS_HOMEPAGE_URL,
            MMS_LINE_XPATH
        );

        $statuses = $this->websiteHandler->getXPathContent(
            MMS_HOMEPAGE_URL,
            MMS_STATUS_XPATH
        );

        if ($this->isGoodStatus($statuses)) {
            if ($this->metrolink->isPeak()) {
                return "Good service on all lines";
            } else {
                return '';
            }
        } else {
            $returnString = '';
            if (count($lines) > 0) {
                foreach ($lines as $n => $line) {
                    $returnString .= $this->generateStatusString(
                        $line,
                        $statuses[$n]
                    );
                }
                $returnString .= "Good service on all other lines.";
            }
            return $returnString;
        }
        
        return '...';
    }

    private function generateStatusString($line, $status)
    {
        if (!$this->isGoodStatus($status)) {
            return $returnString = "{$status} on {$line} line\n";
        }

        return null;
    }
}