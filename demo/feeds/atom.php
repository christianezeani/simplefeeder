<?php

use SimpleFeeder\SimpleFeeder;

$feeder = new SimpleFeeder('atom');
$feeder->title = 'Example Articles';
$feeder->link = 'https://www.example.com';
$feeder->authorName = 'Christian Ezeani';
$feeder->authorUri = 'https://christianezeani.github.io';
$feeder->authorEmail = 'christian@example.com';
$feeder->rights = 'Copyright Example.com';
$feeder->generator = 'SimpleFeeder';

$feeder->add(function ($entry) {
  $entry->id = 'hg kgkhkjhlkhlkj';
  $entry->title = 'Just testing';
  $entry->link = 'https://www.example.com';
  $entry->link = 'https://www.example.com/faq';
  $entry->link = 'https://www.example.com/contact';
  $entry->updated = '2005-07-31T12:29:29Z';
  $entry->published = '2003-12-13T08:29:29-04:00';
  $entry->authorName = 'Christian Ezeani';
  $entry->authorUri = 'https://christianezeani.github.io';
  $entry->authorEmail = 'christian@example.com';
  $entry->contributor = 'Chinonye Nwachukwu';
  $entry->contributor = 'Chioma Nwachukwu';
  $entry(array(
    'type' => 'xhtml',
    'xml:lang' => 'en',
    'xml:base' => 'http://diveintomark.org/'
  ))->content = '<div>Demo Content</div>';
});

$feeder->render();
