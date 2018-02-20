<?php

namespace Thatdamnqa\MancMetFeed;

use stdClass;

/**
  * Gets, and parses, the line status.
  **/
class Status
{
    /**
     * @var WebsiteHandler
     */
    private $websiteHandler;

    /**
     * @var Metrolink
     */
    private $metrolink;

    public function __construct($websiteHandler, $metrolink)
    {
        $this->websiteHandler = $websiteHandler;
        $this->metrolink = $metrolink;
    }

    /**
      * Returns true if all statuses are of a good service
      * (string to watch out for is in config)
      *
      * @param array Status array from API
      *
      * @return bool
      */
    private function isMetrolinkGoodStatus(stdClass $status)
    {
        if (is_object($status)) {
            foreach ($status->items as $s) {
                if ($s->severity != MMS_GOOD_SERVICE_SEVERITY) {
                    return false;
                }
            }

            return true;
        }
    }


    /**
     * Returns true if all statuses are of a good service
     * (string to watch out for is in config)
     *
     * @param string $status String to inspect
     *
     * @return bool
     */
    private function isLineGoodStatus(string $status)
    {
        if (is_string($status)) {
           if ($status == MMS_GOOD_SERVICE_SEVERITY) {
               return true;
           }

           return false;
        }

        return null;
    }

    /**
     * Checks if the line name is valid, and not actually the "Other lines"
     * value from the API.
     *
     * @param string $lineName
     *
     * @return bool
     */
    private function isValidLine(string $lineName)
    {
        if (MMS_OTHER_LINES_STRING != $lineName) {
            return true;
        }

        return false;
    }

    /**
     * Generates the string to tweet for a particular line
     * @param array $status The array to send
     *
     * @return string Tweetable text
     */
    private function generateLineStatusString($status)
    {
        $returnString = '';
        if ($this->isValidLine($status->name)) {
            if (!$this->isLineGoodStatus($status->severity)) {
                $returnString .= "{$status->status} on {$status->name} line\n";
            }
        }

        return $returnString;
    }

    /**
     * Generates a tweet if the line is good
     *
     * @return string Tweetable string
     */
    private function generateGoodStatusString()
    {
        if ($this->metrolink->isPeak()) {
            $hour = $this->metrolink->getCurrentHour().':00';
            return "$hour — Good service on all lines";
        } else {
            return '';
        }
    }

    /**
     * Generates the tweet if the line is bad
     *
     * @param int $hour The current hour
     * @param array $statuses Array of status from API ($this->websiteHandler)
     *
     * @return string Tweetable string
     */
    private function generateBadStatusString($statuses)
    {
        if ($this->metrolink->isPeak()) {
            $hour = $this->metrolink->getCurrentHour();
            $returnString = "$hour:00 — ";
        } else {
            $returnString = '';
        }

        if (count($statuses) > 0) {
            foreach ($statuses->items as $n => $status) {
                $returnString .= $this->generateLineStatusString($status);
            }
            $returnString .= "Good service on all other lines";
        }
        return $returnString;
    }

    /**
     * Get a tweetable status string
     *
     * @param array $statuses Output from WebsiteHandler::get
     * @param string|null $hour The time. Sets to current time if null
     *
     * @return string
     */
    public function getStatusString()
    {
        $statuses = $this->websiteHandler->getMetrolinkStatus();

        if ($this->isMetrolinkGoodStatus($statuses)) {
            return $this->generateGoodStatusString();
        } else {
            return $this->generateBadStatusString($statuses);
        }

        return '...';
    }
}
