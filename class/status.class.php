<?php

/**
  * Gets, and parses, the line status.
  **/
class Status
{
    private $websiteHandler;
    private $metrolink;
    private $previous_status;

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

        $hour = date('ga');

        if ($this->isGoodStatus($statuses)) {
            if ($this->metrolink->isPeak()) {
                return "$hour: Good service on all lines";
            } else {
                return '';
            }
        } else {
            if ($this->metrolink->isPeak()) {
                $returnString = "$hour: ";
            } else {
                $returnString = '';
            }
            if (count($lines) > 0) {
                foreach ($lines as $n => $line) {
                    $returnString .= $this->generateStatusString(
                        $n,
                        $line,
                        $statuses[$n]
                    );
                }
                $returnString .= "\nGood service on all other lines.";
            }
            return $returnString;
        }
        
        return '...';
    }

    private function generateStatusString($n, $line, $status)
    {
        $returnString = '';

        if ($status != $this->previous_status) {
            if ($n != 0) $returnString = "\n"; //If it's not the first line, add a linebreak as it's a new status
            $this->previous_status = $status;
            if (!$this->isGoodStatus($status)) {
                $returnString .= "{$status} on {$line} line";
            }
        } else {
            if (!$this->isGoodStatus($status)) {
                $returnString .= ", {$line} line";
            }
        }

        return $returnString;
    }
}