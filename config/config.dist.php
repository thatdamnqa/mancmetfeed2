<?php
date_default_timezone_set('Europe/London');

// Anything here is appended to the end of all non-blank tweets.
define('ANNOUNCEMENT', '');

// If set to `true`, this turns off tweeting, outputs to the console instead.
define('MMS_DEBUG', false);


// The URL to TfGM's Metrolink status.
define('MMS_API_URL', 'https://tfgm.com/api/statuses/tram');

// The severity keyword for a good service. The script uses this to decide if a line is good service or not.
define('MMS_GOOD_SERVICE_SEVERITY', 'success');

// We ignore any lines called this, as this is appended to all API call results and can be quite useless.
define('MMS_OTHER_LINES_STRING', 'Other lines');

// Twitter API keys.
define('TWITTER_USERNAME',       '@MancMetFeed');
define('TWITTER_CONSUMERKEY',    '');
define('TWITTER_CONSUMERSECRET', '');
define(
    'TWITTER_ACCESSTOKEN',
    ''
);
define('TWITTER_ACCESSTOKENSECRET', '');
