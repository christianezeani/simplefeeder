<?php
namespace SimpleFeeder\Entries;

use SimpleFeeder\Core\Entry;
use SimpleFeeder\Traits\UsesDomFunctions;
use DOMDocument, DOMElement;

class SitemapFeederEntry extends Entry {

  use UsesDomFunctions;

  /**
   * @var DOMElement
   */
  private $parent;

  /**
   * @var DOMElement
   */
  private $loc,
    $lastmod,
    $changefreq,
    $priority;

  function __construct(DOMDocument $dom, DOMElement $parent) {
    $this->dom = &$dom;
    $this->parent = &$parent;

    $this->root = $dom->createElement('url');
    $parent->appendChild($this->root);
  }

  function __destruct() {
    $this->parent->removeChild($this->root);
  }

  public function getLocValue() {
    return $this->getValue($this->loc);
  }

  public function setLocValue($value, $attributes) {
    $this->setValueToRoot($this->loc, 'loc', $value, $attributes);
  }

  public function getLastmodValue() {
    return $this->getValue($this->lastmod);
  }

  public function setLastmodValue($value, $attributes) {
    $this->setValueToRoot($this->lastmod, 'lastmod', $value, $attributes);
  }

  public function getChangefreqValue() {
    return $this->getValue($this->changefreq);
  }

  public function setChangefreqValue($value, $attributes) {
    $this->setValueToRoot($this->changefreq, 'changefreq', $value, $attributes);
  }

  public function getPriorityValue() {
    return $this->getValue($this->priority);
  }

  public function setPriorityValue($value, $attributes) {
    $this->setValueToRoot($this->priority, 'priority', $value, $attributes);
  }

}

