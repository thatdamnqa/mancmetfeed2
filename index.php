<?php
require_once('config/config.php');
require_once('class/tweet.class.php');
require_once('class/websitehandler.class.php');
require_once('class/status.class.php');
require_once('class/metrolink.class.php');

$tweetClass = new Tweet();
$metrolinkClass = new Metrolink(new DateTimeImmutable());
$websiteHandlerClass = new WebsiteHandler(MMS_API_URL);
$statusClass = new Status($websiteHandlerClass, $metrolinkClass);

$statusString = $statusClass->getStatusString();

$tweets = $tweetClass->generate($statusString);

if (null == $tweets) {
} else {
    $first_tweet_id = null;
    foreach ($tweets as $key => $t) {
        $tweetid = $tweetClass->post($t, $first_tweet_id);

        if ($key == 0 && $tweetid) {
            $first_tweet_id = $tweetid;
        }

        if (MMS_DEBUG === true) {
            echo "---\n";
        }
    }
}
