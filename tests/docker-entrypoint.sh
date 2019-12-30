#!/bin/sh

php -v
php -q test_memcached.php
php -q test-redis.php
php -q check-memcache.php

/bin/true
