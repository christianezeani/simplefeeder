<?php
namespace SimpleFeeder\Entries;

use SimpleFeeder\Core\Entry;
use SimpleFeeder\Traits\UsesDomFunctions;
use DOMDocument, DOMElement;

class AtomFeederEntry extends Entry {

  use UsesDomFunctions;

  /**
   * @var DOMDocument
   */
  private $dom;

  /**
   * @var DOMElement
   */
  private $root;

  /**
   * @var DOMElement
   */
  private $id, $title, $updated, $published, $author, $authorName, $authorUri, $authorEmail, $content;

  /**
   * @var DOMElement[]
   */
  private $link, $contributor;

  function __construct(DOMDocument $dom) {
    $this->dom = $dom;

    $this->root = $dom->createElement('entry');
    $dom->documentElement->appendChild($this->root);
  }

  function __destruct() {
    $docRoot = &$this->dom->documentElement;
    $docRoot->removeChild($this->root);
  }

  public function getIdValue() {
    return $this->getValue($this->id);
  }

  public function setIdValue($value, $attributes) {
    $this->setValueToRoot($this->id, 'id', $value, $attributes);
  }

  public function getTitleValue() {
    return $this->getValue($this->title);
  }

  public function setTitleValue($value, $attributes) {
    $this->setValueToRoot($this->title, 'title', $value, $attributes);
  }

  public function getLinkValue() {
    return $this->getValueAttributeArray($this->link, 'href');
  }

  public function setLinkValue($value, $attributes) {
    $this->addValueAttributeToRoot($this->link, 'link', 'href', $value, $attributes);
  }
  
  public function getUpdatedValue() {
    return $this->getValue($this->updated);
  }

  public function setUpdatedValue($value, $attributes) {
    $this->setValueToRoot($this->updated, 'updated', $value, $attributes);
  }
  
  public function getPublishedValue() {
    return $this->getValue($this->published);
  }

  public function setPublishedValue($value, $attributes) {
    $this->setValueToRoot($this->published, 'published', $value, $attributes);
  }
  
  public function getAuthorNameValue() {
    return $this->getValue($this->authorName);
  }

  public function setAuthorNameValue($value, $attributes) {
    $this->ensureParentElement($this->author, 'author');
    $this->setValue($this->author, $this->authorName, 'name', $value, $attributes);
  }
  
  public function getAuthorUriValue() {
    return $this->getValue($this->authorUri);
  }

  public function setAuthorUriValue($value, $attributes) {
    $this->ensureParentElement($this->author, 'author');
    $this->setValue($this->author, $this->authorUri, 'uri', $value, $attributes);
  }
  
  public function getAuthorEmailValue() {
    return $this->getValue($this->authorEmail);
  }

  public function setAuthorEmailValue($value, $attributes) {
    $this->ensureParentElement($this->author, 'author');
    $this->setValue($this->author, $this->authorEmail, 'email', $value, $attributes);
  }
  
  public function getContributorValue() {
    return $this->getValue($this->contributor);
  }

  public function setContributorValue($value, $attributes) {
    $contributor =  $name = NULL;
    $contributor = $this->addValueToRoot($this->contributor, 'contributor', '');
    $this->setValue($contributor, $name, 'name', $value, $attributes);
  }
  
  public function getContentValue() {
    return $this->getValue($this->content);
  }

  public function setContentValue($value, $attributes) {
    $this->setValueToRoot($this->content, 'content', $value, $attributes);
  }

}

