<?php
namespace Thatdamnqa\MancMetFeed;
require_once '../config/config.php';

use Thatdamnqa\MancMetFeed\Services\TwitterNotifierClientFactory;
require __DIR__ . '/../vendor/autoload.php';

$tweetClass = new Tweet(TwitterNotifierClientFactory::getClient());
$metrolinkClass = new Metrolink(new \DateTimeImmutable());
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
