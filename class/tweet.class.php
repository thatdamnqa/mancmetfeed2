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
    public function generate($status)
    {
        if ($status == '') return null;
        $tweetlength = 140;

        // Splits into tweet-length number of characters, breaking at
        // new line
        $tweet_lines = explode("\n", $status);
        $tweets = [''];
        foreach ($tweet_lines as $n => $line) {
                $current_tweet_id = count($tweets) - 1;
                $length_of_current_tweet = strlen($tweets[$current_tweet_id]);
                $length_of_line_to_add = strlen($line);
                if ($length_of_current_tweet + $length_of_line_to_add < $tweetlength) {
                    $tweets[$current_tweet_id] .= $line . "\n";
                } else {
                    $tweets[] = $line . "\n";
                }
        }

        return $tweets;
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
