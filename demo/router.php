<?php
require_once(__DIR__.'/../vendor/autoload.php');

$uri = $_SERVER['REQUEST_URI'];

if ($uri === '/') {
  include(__DIR__.'/index.html');
} else if (preg_match("/\/?(.+)\.(xml|atom|rss|json)$/", $uri, $match)) {
  list ($path, $file, $ext) = $match;
  
  $filename = __DIR__.'/feeds/'.$file.'.php';
  if (is_file($filename)) {
    include($filename);
  } else {
    echo 'Invalid Feed';
  }
} else {
  echo 'Page not found!';
}
