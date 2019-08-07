<?php

use SimpleFeeder\SimpleFeeder;

$feeder = new SimpleFeeder('rss');
$feeder->title = 'RSS Title';
$feeder->description = 'Example Description';
$feeder->link = 'https://www.example.com';
$feeder->lastBuildDate = 'Mon, 06 Sep 2010 00:01:00 +0000';
$feeder->pubDate = 'Sun, 06 Sep 2009 16:20:00 +0000';
$feeder->ttl = '1800';

$feeder->add(function ($entry) {
  $entry->title = 'Example entry';
  $entry->description = 'Here is some text containing an interesting description.';
  $entry->link = 'https://www.example.com';
  $entry(array(
    'isPermaLink' => 'false'
  ))->guid = '7bd204c6-1655-4c27-aeee-53f933c5395f';
  $entry->pubDate = 'Sun, 06 Sep 2009 16:20:00 +0000';
});

$feeder->add(function ($entry) {
  $entry->title = 'Example entry 2';
  $entry->description = 'Here is some text containing an interesting description.';
  $entry->link = 'https://www.example.com';
  $entry(array(
    'isPermaLink' => 'false'
  ))->guid = '7bd204c6-1655-4c27-aeee-53f933c5395f';
  $entry->pubDate = 'Sun, 06 Sep 2009 16:20:00 +0000';
});

$feeder->render();
