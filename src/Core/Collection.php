<?php
namespace SimpleFeeder\Core;

use SimpleFeeder\Exceptions\InvalidEntryException;
use SimpleFeeder\Exceptions\InvalidCollectionItemException;

/**
 * Holds a collection of data
 */
class Collection implements ArrayAccess, JsonSerializable {

  private $_type;

  private $_items = [];

  /**
   * Collection Constructor
   * 
   * Initializes Collection with optional
   *
   * @param array $data Array of data
   * @param string $type Data type for use in validating $data
   */
  function __construct(array $data = array(), string $type = '') {
    if (!empty($type) && !is_subclass_of($type, Entry::class, true)) {
      $message = "Expected a subclass of '".Entry::class."', '".$type."' provided!";
      throw new InvalidEntryException($message);
    }

    $this->_type = $type;

    $this->concat($data);
  }

  /**
   * @ignore Validates an input
   */
  private function validate($data) {
    if (empty($this->_type)) return;

    if (!is_object($data) || !is_a($data, $this->_type)) {
      $message = 'Expected an instance of "'.$this->_type.'", "'.get_class($data).'" given.';
      throw new InvalidCollectionItemException($message);
    }
  }

  public function add($entry) {
    $this->validate($entry);
    $this->_items[] = $entry;
    return $this;
  }

  public function concat($data) {
    if (is_array($data) && count($data)) {
      foreach ($data as $value) {
        $this->add($value);
      }
    }
    return $this;
  }

  public function count() {
    return count($this->_items);
  }
  
  public function length() {
    return $this->count();
  }

  public function remove($index) {
    $this->splice($index, 1);
    return $this;
  }

  public function &item($index) {
    if (!is_int($index) || !array_key_exists($index, $this->_items)) {
      return $item = NULL;
    }
    return $this->_items[$index];
  }

  public function each($callable) {
    if (!is_callable($callable)) {
      foreach ($this->_items as $index => &$item) {
        call_user_func_array($callable, [&$item, $index]);
        $this->validate($item);
      }
    }
    return $this;
  }

  public function slice($offset, $length, $preserve_keys) {
    if (!is_int($offset)) $offset = 0;
    if (!is_int($length)) $length = $this->count();
    if (!is_bool($preserve_keys)) $preserve_keys = false;

    $result = array_slice($this->_items, $offset, $length, $preserve_keys);
    return new self($result, $this->_type);
  }

  public function splice($offset, $length = NULL, $replacement = array()) {
    if (!is_int($length) || $length <= 0) $length = $this->count();
    if (!is_array($replacement)) $replacement = array();

    $result = array_splice($this->_items, $offset, $length, $replacement);
    return new self($result, $this->_type);
  }

  public function clear() {
    $this->_items = [];
    return $this;
  }

}

