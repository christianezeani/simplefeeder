<?php
namespace SimpleFeeder\Traits;

trait UsesCustomValues {

  private $attributes = array();

  public function __isset($name) {
    // 
  }

  public function __unset($name) {
    // 
  }
  
  public function __get($name) {
    $method = 'get'.ucfirst($name).'Value';
    if (method_exists($this, $method)) {
      return $this->{$method}();
    }
    return NULL;
  }

  public function __set($name, $value) {
    $method = 'set'.ucfirst($name).'Value';
    if (method_exists($this, $method)) {
      $this->{$method}($value, $this->attributes);
    }
    $this->attributes = array();
  }

  public function __invoke($attributes) {
    if (!$attributes) $attributes = array();
    $this->attributes = $attributes;
    return $this;
  }

}
