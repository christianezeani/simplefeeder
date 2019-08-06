<?php
namespace SimpleFeeder\Feeders;

use SimpleFeeder\Core\Feeder;
use SimpleFeeder\Entries\AtomFeederEntry;
use SimpleFeeder\Traits\UsesDomReaderWriter;
use DOMElement;

class AtomFeeder extends Feeder {

  use UsesDomReaderWriter;

  protected $entryType = AtomFeederEntry::class;

  /**
   * @var DOMElement
   */
  private $root;

  /**
   * @var DOMElement
   */
  private $id;

  /**
   * @var DOMElement
   */
  private $title;

  /**
   * @var DOMElement
   */
  private $link;

  /**
   * @var DOMElement
   */
  private $author;

  /**
   * @var DOMElement
   */
  private $authorName;

  /**
   * @var DOMElement
   */
  private $authorUri;

  /**
   * @var DOMElement
   */
  private $authorEmail;

  /**
   * @var DOMElement
   */
  private $updated;

  /**
   * @var DOMElement
   */
  private $published;

  /**
   * @var DOMElement
   */
  private $rights;

  /**
   * @var DOMElement
   */
  private $generator;

  protected function onDomReady() {
    $this->root = $this->dom->createElement('feed');
    $this->root->setAttribute('xmlns', 'http://www.w3.org/2005/Atom');
    $this->dom->appendChild($this->root);
  }

  public function getIdValue() {
    if (!$this->id) return NULL;
    return $this->id->textContent;
  }

  public function setIdValue($value, $attributes) {
    if ($this->id) $this->root->removeChild($this->id);
    $this->id = $this->dom->createElement('id', $value);
    $this->setExtraAttributes($this->id, $attributes);
    $this->root->appendChild($this->id);
  }

  public function getTitleValue() {
    if (!$this->title) return NULL;
    return $this->title->textContent;
  }

  public function setTitleValue($value, $attributes) {
    if ($this->title) $this->root->removeChild($this->title);
    $this->title = $this->dom->createElement('title', $value);
    $this->setExtraAttributes($this->title, $attributes);
    $this->root->appendChild($this->title);
  }

  public function getLinkValue() {
    if (!$this->link) return NULL;
    return $this->link->getAttribute('href');
  }

  public function setLinkValue($value, $attributes) {
    if (!$this->link) {
      $this->link = $this->dom->createElement('link');
      $this->root->appendChild($this->link);
    }

    $this->setExtraAttributes($this->link, $attributes, 'href');

    $this->link->removeAttribute('href');
    $this->link->setAttribute('href', $value);
  }

  public function getUpdatedValue() {
    if (!$this->updated) return NULL;
    return $this->updated->textContent;
  }

  public function setUpdatedValue($value, $attributes) {
    if ($this->updated) $this->root->removeChild($this->updated);
    $this->updated = $this->dom->createElement('updated', $value);
    $this->setExtraAttributes($this->updated, $attributes);
    $this->root->appendChild($this->updated);
  }

  public function getAuthorNameValue() {
    if (!$this->authorName) return NULL;
    return $this->authorName->textContent;
  }

  public function setAuthorNameValue($value, $attributes) {
    $this->ensureAuthorParentElement();
    if ($this->authorName) $this->author->removeChild($this->authorName);
    $this->authorName = $this->dom->createElement('name', $value);
    $this->setExtraAttributes($this->authorName, $attributes);
    $this->author->appendChild($this->authorName);
  }

  public function getAuthorUriValue() {
    if (!$this->authorUri) return NULL;
    return $this->authorUri->textContent;
  }

  public function setAuthorUriValue($value, $attributes) {
    $this->ensureAuthorParentElement();
    if ($this->authorUri) $this->author->removeChild($this->authorUri);
    $this->authorUri = $this->dom->createElement('uri', $value);
    $this->setExtraAttributes($this->authorUri, $attributes);
    $this->author->appendChild($this->authorUri);
  }

  public function getAuthorEmailValue() {
    if (!$this->authorEmail) return NULL;
    return $this->authorEmail->textContent;
  }

  public function setAuthorEmailValue($value, $attributes) {
    $this->ensureAuthorParentElement();
    if ($this->authorEmail) $this->author->removeChild($this->authorEmail);
    $this->authorEmail = $this->dom->createElement('email', $value);
    $this->setExtraAttributes($this->authorEmail, $attributes);
    $this->author->appendChild($this->authorEmail);
  }

  public function getRightsValue() {
    if (!$this->rights) return NULL;
    return $this->rights->textContent;
  }

  public function setRightsValue($value, $attributes) {
    if ($this->rights) $this->root->removeChild($this->rights);
    $this->rights = $this->dom->createElement('rights', $value);
    $this->setExtraAttributes($this->rights, $attributes);
    $this->root->appendChild($this->rights);
  }

  public function getGeneratorValue() {
    if (!$this->generator) return NULL;
    return $this->generator->textContent;
  }

  public function setGeneratorValue($value, $attributes) {
    if ($this->generator) $this->root->removeChild($this->generator);
    $this->generator = $this->dom->createElement('generator', $value);
    $this->setExtraAttributes($this->generator, $attributes);
    $this->root->appendChild($this->generator);
  }

  private function ensureAuthorParentElement() {
    if (!$this->author) {
      $this->author = $this->dom->createElement('author');
      $this->root->appendChild($this->author);
    }
  }

  private function setExtraAttributes(DOMElement &$element, $attributes, $exclude = '') {
    if (!is_array($attributes)) $attributes = array();

    foreach ($attributes as $name => $value) {
      if ($exclude && $exclude === $name) continue;
      $element->removeAttribute($name);
      $element->setAttribute($name, $value);
    }
  }

  protected function onBeforeRender() {
    if (!headers_sent()) {
      header('Content-Type: text/xml');
    }
  }
  
}

