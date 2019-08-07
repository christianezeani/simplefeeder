<?php

use SimpleFeeder\SimpleFeeder;

$feeder = new SimpleFeeder('sitemap');

$feeder->add(function ($entry) {
  $entry->loc = 'https://www.example.com';
  $entry->lastmod = '2005-01-01';
  $entry->changefreq = 'monthly';
  $entry->priority = '0.8';
});

$feeder->add(function ($entry) {
  $entry->loc = 'https://www.example.com';
  $entry->lastmod = '2005-01-01';
  $entry->changefreq = 'monthly';
  $entry->priority = '0.8';
});

$feeder->render();
