<?php
namespace SimpleFeeder\Core;

use SimpleFeeder\Exceptions\InvalidEntryException;

class Collection implements ArrayAccess, JsonSerializable {

  private $_type;

  function __construct(string $type) {
    if (!is_subclass_of($type, Entry::class, true)) {
      $message = "Expected a subclass of '".Entry::class."', '".$type."' provided!";
      throw new InvalidEntryException($message);
    }

    $this->_type = $type;
  }

}
