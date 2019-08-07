<?php
namespace SimpleFeeder\Traits;

use SimpleFeeder\Exceptions\InvalidEntryException;

trait HasEntryType {

  protected $entryType = '';

  protected function validateEntry($entry) {
    if (empty($this->entryType)) return;

    if (!is_object($entry) || !is_a($entry, $this->entryType)) {
      $message = 'Expected an instance of "'.$this->entryType.'", "'.get_class($entry).'" given.';
      throw new InvalidEntryException($message);
    }
  }

  protected function createNewEntry(...$args) {
    if (empty($this->entryType)) return NULL;
    if (!class_exists($this->entryType)) return NULL;
    return new $this->entryType(...$args);
  }

  protected function newEntryParameters() {
    return array();
  }

}
