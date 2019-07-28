<?php
namespace SimpleFeeder\Traits;

use stdClass;

trait HasDynamicFields {

  protected $fields = array();

  private $data;

  private function initializeDynamicFields() {
    $this->data = new stdClass;
  }

  public function __isset($name) {
    return isset($this->data->{$name});
  }

  public function __unset($name) {
    unset($this->data->{$name});
  }

  public function __set($name, $value) {
    if (array_key_exists($name, $this->fields)) {
      $this->data->{$name} = $value;
    }
  }

  public function __get($name) {
    return $this->data->{$name};
  }

}
