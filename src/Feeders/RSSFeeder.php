<?php
namespace SimpleFeeder\Feeders;

use SimpleFeeder\Entries\RSSFeederEntry;
use SimpleFeeder\Traits\UsesDomReaderWriter;

use SimpleFeeder\Core\Feeder;

use DOMDocument, DOMElement;

class RSSFeeder extends Feeder {

  use UsesDomReaderWriter;
  
  protected $entryType = RSSFeederEntry::class;

  /**
   * @var DOMElement
   */
  private $root, $channel;

  private $title,
    $description,
    $link,
    $lastBuildDate,
    $pubDate,
    $ttl;

  protected function onDomReady() {
    $this->root = $this->dom->createElement('rss');
    $this->root->setAttribute('version', '2.0');
    $this->dom->appendChild($this->root);

    $this->channel = $this->dom->createElement('channel');
    $this->root->appendChild($this->channel);
  }

  public function getTitleValue() {
    return $this->getValue($this->title);
  }

  public function setTitleValue($value, $attributes) {
    $this->setValue($this->channel, $this->title, 'title', $value, $attributes);
  }

  public function getDescriptionValue() {
    return $this->getValue($this->description);
  }

  public function setDescriptionValue($value, $attributes) {
    $this->setValue($this->channel, $this->description, 'description', $value, $attributes);
  }

  public function getLinkValue() {
    return $this->getValue($this->link);
  }

  public function setLinkValue($value, $attributes) {
    $this->setValue($this->channel, $this->link, 'link', $value, $attributes);
  }

  public function getLastBuildDateValue() {
    return $this->getValue($this->lastBuildDate);
  }

  public function setLastBuildDateValue($value, $attributes) {
    $this->setValue($this->channel, $this->lastBuildDate, 'lastBuildDate', $value, $attributes);
  }

  public function getPubDateValue() {
    return $this->getValue($this->pubDate);
  }

  public function setPubDateValue($value, $attributes) {
    $this->setValue($this->channel, $this->pubDate, 'pubDate', $value, $attributes);
  }

  public function getTtlValue() {
    return $this->getValue($this->ttl);
  }

  public function setTtlValue($value, $attributes) {
    $this->setValue($this->channel, $this->ttl, 'ttl', $value, $attributes);
  }

  protected function onBeforeRender() {
    if (!headers_sent()) {
      header('Content-Type: text/xml');
    }
  }

  protected function newEntryParameters() {
    return array(&$this->dom, &$this->channel);
  }

}

