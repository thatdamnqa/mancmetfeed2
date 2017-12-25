<?php

namespace ThatDamnQA\MancMetFeed;

use ThatDamnQA\MancMetFeed\Services\TwitterNotifierClientFactory;

require __DIR__ . '/../vendor/autoload.php';

$tweetClass = new Tweet(TwitterNotifierClientFactory::getClient());
$metrolinkClass = new Metrolink();
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
