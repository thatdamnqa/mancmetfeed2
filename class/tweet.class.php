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

    /**
     * Send out Tweet to Twitter
     * Or print to console if MMS_DEBUG is set to `true`
     *
     * @param string $tweet
     * @param int $original_tweet_id The ID of the first tweet, used so that future tweets are a reply chain.
     * @return bool|string True if sent to console, false on failure, tweet ID on success
     */
    public function post($tweet, $original_tweet_id = null)
    {
        // Twitter API rules say that all reply-to tweets should contain
        // the original tweeter's username.
        //
        // Tweet character limits ignore @usernames at the start, so we don't
        // need to worry about this.
        if ($original_tweet_id) {
            //$tweet = TWITTER_USERNAME . ' ' . $tweet;
        }

        if (true == MMS_DEBUG) {
            echo $tweet;
            return true;
        }

        $twitter = new Twitter(
            TWITTER_CONSUMERKEY,
            TWITTER_CONSUMERSECRET,
            TWITTER_ACCESSTOKEN,
            TWITTER_ACCESSTOKENSECRET
        );

        return $twitter->send($tweet, $original_tweet_id);
    }
}
