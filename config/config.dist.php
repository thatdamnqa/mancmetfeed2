<?php
date_default_timezone_set('UTC');


define('MMS_DEBUG', false); // Turns off tweeting, outputs to the console instead

define('MMS_HOMEPAGE_URL', 'http://www.metrolink.co.uk');
define('MMS_LINE_XPATH', '//*[@class="line-symbol"]');
define('MMS_STATUS_XPATH', '//*[@class="service-status"]');
define('MMS_GOOD_SERVICE_STRING', 'Good Service');

define('TWITTER_CONSUMERKEY',    '');
define('TWITTER_CONSUMERSECRET', '');
define(
    'TWITTER_ACCESSTOKEN',
    ''
);
define('TWITTER_ACCESSTOKENSECRET', '');