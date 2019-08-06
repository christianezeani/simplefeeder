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
$feeder->render();
