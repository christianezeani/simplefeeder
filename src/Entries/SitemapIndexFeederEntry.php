<?php
namespace SimpleFeeder\Entries;

use SimpleFeeder\Core\Entry;
use SimpleFeeder\Traits\UsesDomFunctions;
use DOMDocument, DOMElement;

class SitemapIndexFeederEntry extends Entry {

  use UsesDomFunctions;

  /**
   * @var DOMElement
   */
  private $parent;

  /**
   * @var DOMElement
   */
  private $loc, $lastmod;

  function __construct(DOMDocument $dom, DOMElement $parent) {
    $this->dom = &$dom;
    $this->parent = &$parent;

    $this->root = $dom->createElement('sitemap');
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

}

