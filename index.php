<?php
require_once('config/config.php');
require_once('class/tweet.class.php');
require_once('class/websitehandler.class.php');
require_once('class/status.class.php');
require_once('class/metrolink.class.php');

$tweetClass = new Tweet();
$metrolinkClass = new Metrolink();
$websiteHandlerClass = new WebsiteHandler();
$statusClass = new Status($websiteHandlerClass, $metrolinkClass);

$statusString = $statusClass->getStatusString();

$tweets = $tweetClass->generate($statusString);

if (null == $tweets) {
} else {
    foreach ($tweets as $t) {
        $tweetClass->post($t);
        if (MMS_DEBUG === true) {
            echo "---\n";
        }
    }
}
