<?php

use SimpleFeeder\SimpleFeeder;

$feeder = new SimpleFeeder('sitemapIndex');

$feeder->add(function ($entry) {
  $entry->loc = 'https://www.example.com/sitemap1.xml.gz';
  $entry->lastmod = '2005-01-01';
  $entry->changefreq = 'monthly';
  $entry->priority = '0.8';
});

$feeder->add(function ($entry) {
  $entry->loc = 'https://www.example.com/sitemap2.xml.gz';
  $entry->lastmod = '2005-01-01';
  $entry->changefreq = 'monthly';
  $entry->priority = '0.8';
});

$feeder->render();
