<?php
namespace SimpleFeeder\Core;

use SimpleFeeder\Traits\CanReadFeed;
use SimpleFeeder\Traits\CanWriteFeed;
use SimpleFeeder\Traits\CanCallStaticMethods;

class Feeder {

  use CanReadFeed, CanWriteFeed, CanCallStaticMethods;

  public function add(Entry $entry) {
    // 
  }

  public function remove(Entry $entry) {
    // 
  }

}
