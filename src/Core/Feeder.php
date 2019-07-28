<?php
namespace SimpleFeeder\Core;

use SimpleFeeder\Traits\CanReadAndWriteFeed;

abstract class Feeder {

  use CanReadAndWriteFeed;

  function __construct($data = array()) {
    $this->initializeDynamicFields();
    $this->createCollection($data, $this->entryType);
    $this->initialize();
  }

  abstract protected function initialize();

  public function clear() {
    $this->collection->clear();
    return $this;
  }

}
