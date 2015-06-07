<?php
require_once('class/3rdparty/OAuth.php');
require_once('class/3rdparty/twitter.class.php');

/**
  * Generate tweet string
  **/
class Tweet
{
    /**
     * Generate tweet from body
     * Returns array of tweets
     *
     * @param $body
     * @return array or false if no data
     */
    public function generate($body)
    {
        if ($body == '') return null;
        
        $tweetlength = 140;
        $tweet = $body;

        return str_split($tweet, $tweetlength);
    }

    public function post($tweet)
    {
        if (true == MMS_DEBUG) {
            echo $tweet;
        } else {
            $twitter = new Twitter(
                TWITTER_CONSUMERKEY,
                TWITTER_CONSUMERSECRET,
                TWITTER_ACCESSTOKEN,
                TWITTER_ACCESSTOKENSECRET
            );
            $twitter->send($tweet);
        }
    }
}