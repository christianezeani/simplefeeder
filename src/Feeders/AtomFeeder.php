<?php
namespace SimpleFeeder\Feeders;

use SimpleFeeder\Core\Feeder;
use SimpleFeeder\Entries\AtomFeederEntry;
use SimpleFeeder\Traits\UsesDomReaderWriter;
use SimpleFeeder\Traits\UsesDomFunctions;
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
  private $id,
    $title,
    $author,
    $icon,
    $logo,
    $authorName,
    $authorUri,
    $authorEmail,
    $updated,
    $published,
    $rights,
    $generator;
  
  /**
   * @var DOMElement[]
   */
  private $link;

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
    $this->setValueToRoot($this->id, 'id', $value, $attributes);
  }

  public function getTitleValue() {
    if (!$this->title) return NULL;
    return $this->title->textContent;
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
  
  public function getIconValue() {
    return $this->getValue($this->icon);
  }

  public function setIconValue($value, $attributes) {
    $this->setValueToRoot($this->icon, 'icon', $value, $attributes);
  }

  public function getLogoValue() {
    return $this->getValue($this->logo);
  }

  public function setLogoValue($value, $attributes) {
    $this->setValueToRoot($this->logo, 'logo', $value, $attributes);
  }

  public function getUpdatedValue() {
    if (!$this->updated) return NULL;
    return $this->updated->textContent;
  }

  public function setUpdatedValue($value, $attributes) {
    $this->setValueToRoot($this->updated, 'updated', $value, $attributes);
  }

  public function getAuthorNameValue() {
    if (!$this->authorName) return NULL;
    return $this->authorName->textContent;
  }

  public function setAuthorNameValue($value, $attributes) {
    $this->ensureParentElement($this->author, 'author');
    $this->setValue($this->author, $this->authorName, 'name', $value, $attributes);
  }

  public function getAuthorUriValue() {
    if (!$this->authorUri) return NULL;
    return $this->authorUri->textContent;
  }

  public function setAuthorUriValue($value, $attributes) {
    $this->ensureParentElement($this->author, 'author');
    $this->setValue($this->author, $this->authorUri, 'uri', $value, $attributes);
  }

  public function getAuthorEmailValue() {
    if (!$this->authorEmail) return NULL;
    return $this->authorEmail->textContent;
  }

  public function setAuthorEmailValue($value, $attributes) {
    $this->ensureParentElement($this->author, 'author');
    $this->setValue($this->author, $this->authorEmail, 'email', $value, $attributes);
  }

  public function getRightsValue() {
    if (!$this->rights) return NULL;
    return $this->rights->textContent;
  }

  public function setRightsValue($value, $attributes) {
    $this->setValueToRoot($this->rights, 'rights', $value, $attributes);
  }

  public function getGeneratorValue() {
    if (!$this->generator) return NULL;
    return $this->generator->textContent;
  }

  public function setGeneratorValue($value, $attributes) {
    $this->setValueToRoot($this->generator, 'generator', $value, $attributes);
  }

  protected function onBeforeRender() {
    if (!headers_sent()) {
      header('Content-Type: text/xml');
    }
  }

  protected function newEntryParameters() {
    return array(&$this->dom);
  }
  
}

