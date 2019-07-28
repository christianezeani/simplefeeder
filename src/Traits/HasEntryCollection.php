<?php
namespace SimpleFeeder\Traits;

use SimpleFeeder\Core\Collection;
use SimpleFeeder\Exceptions\InvalidCallbackException;

trait HasEntryCollection {

  use HasEntryType;

  /**
   * Collection
   *
   * @var Collection
   */
  private $collection;

  /**
   * Creates an Collection instance
   * 
   * @param array $data
   * @param string $type
   * @return void
   * 
   * @ignore
   */
  private function createCollection($data = array(), $type = '') {
    $this->collection = new Collection($data, $type);
  }

  /**
   * Returns a reference to the entry collection
   *
   * @return Collection
   */
  public function &entries() {
    return $this->collection;
  }

  /**
   * Adds a new entry to the collection
   *
   * @param callable $callable
   * @return $this
   */
  public function add($callable) {
    if (!is_callable($callable)) {
      $message = 'Expected a callable, "'.gettype($callable).'" given.';
      throw new InvalidCallbackException($message);
    }

    $entry = $this->createNewEntry();
    call_user_func_array($callable, [&$entry]);
    $this->collection->add($entry);
    
    return $this;
  }

  /**
   * Removes an entry from the collection
   *
   * @param int $index
   * @return $this
   */
  public function remove($index) {
    $this->collection->remove($index);
    return $this;
  }

}
