<?php
namespace SimpleFeeder\Core;

use SimpleFeeder\Traits\UsesCustomValues;
use SimpleFeeder\Traits\CanReadAndWriteFeed;

abstract class Feeder {

  use UsesCustomValues;
  use CanReadAndWriteFeed;

  function __construct($data = array()) {
    $this->createCollection($data, $this->entryType);
    $this->initialize();
  }

  abstract protected function initialize();

  public function clear() {
    $this->collection->clear();
    return $this;
  }

}
