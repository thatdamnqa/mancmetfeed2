Manchester Metrolink Status tweetbot (@mancmetfeed) -- v3

Twitter bot to read, and tweet, the status of Manchester Metrolink.
Daniel Shaw, 2012 – 2017.

Usage
===

Copy `config/config.dist.php` to `config.php` and complete the Twitter credentials.

The script should be run in a crontab:

```
1 * * * * cd /path/to/mancmetfeed2; php public/index.php
```

but can also be ran on the commandline:

```
php public/index.php
```


To run the unit tests:

```
vendor/bin/phpunit tests
```