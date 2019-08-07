<?php
namespace SimpleFeeder\Entries;

use SimpleFeeder\Core\Entry;
use SimpleFeeder\Traits\UsesDomFunctions;
use DOMDocument, DOMElement;

class RSSFeederEntry extends Entry {

  use UsesDomFunctions;

  /**
   * Undocumented variable
   *
   * @var DOMElement
   */
  private $channel,
    $title,
    $description,
    $link,
    $guid,
    $pubDate;

  function __construct(DOMDocument $dom, DOMElement $channel) {
    $this->dom = &$dom;
    $this->channel = &$channel;

    $this->root = $dom->createElement('item');
    $channel->appendChild($this->root);
  }

  function __destruct() {
    $this->channel->removeChild($this->root);
  }

  public function getTitleValue() {
    return $this->getValue($this->title);
  }

  public function setTitleValue($value, $attributes) {
    $this->setValueToRoot($this->title, 'title', $value, $attributes);
  }

  public function getDescriptionValue() {
    return $this->getValue($this->description);
  }

  public function setDescriptionValue($value, $attributes) {
    $value = $this->dom->createCDATASection($value);
    $this->setValueToRoot($this->description, 'description', '', $attributes);
    $this->description->appendChild($value);
  }

  public function getLinkValue() {
    return $this->getValue($this->link);
  }

  public function setLinkValue($value, $attributes) {
    $this->setValueToRoot($this->link, 'link', $value, $attributes);
  }

  public function getGuidValue() {
    return $this->getValue($this->guid);
  }

  public function setGuidValue($value, $attributes) {
    $this->setValueToRoot($this->guid, 'guid', $value, $attributes);
  }

  public function getPubDateValue() {
    return $this->getValue($this->pubDate);
  }

  public function setPubDateValue($value, $attributes) {
    $this->setValueToRoot($this->pubDate, 'pubDate', $value, $attributes);
  }

}

