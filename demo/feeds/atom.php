<?php

use SimpleFeeder\SimpleFeeder;

$feeder = new SimpleFeeder('atom');
$feeder->title = 'ArticlesPond Articles';
$feeder->link = 'https://www.articlespond.com';
$feeder->authorName = 'Christian Ezeani';
$feeder->authorUri = 'https://christianezeani.github.io';
$feeder->authorEmail = 'christian.ezeani@gmail.com';
$feeder->rights = 'Copyright ArticlesPond.com';
$feeder->generator = 'SimpleFeeder';

$feeder->add(function ($entry) {
  $entry->id = 'hg kgkhkjhlkhlkj';
  $entry->title = 'Just testing';
  $entry->link = 'https://www.articlespond.com';
  $entry->link = 'https://www.articlespond.com/faq';
  $entry->link = 'https://www.articlespond.com/contact';
  $entry->updated = 'now';
  $entry->published = 'now';
  $entry->authorName = 'Christian Ezeani';
  $entry->authorUri = 'https://christianezeani.github.io';
  $entry->authorEmail = 'christian@example.com';
  $entry->contributor = 'Chinonye Nwachukwu';
  $entry->contributor = 'Chioma Nwachukwu';
});

$feeder->render();
