<?php
namespace SimpleFeeder\Traits;

use DOMDocument, DOMElement;

trait UsesDomFunctions {

  /**
   * Undocumented variable
   *
   * @var DOMDocument
   * 
   * @ignore
   */
  private $dom;

  /**
   * @var DOMElement
   */
  private $root;
  
  /**
   * Undocumented function
   *
   * @param DOMElement $element
   * @param array $attributes
   * @param string $exclude
   * @return void
   */
  private function setExtraAttributes(DOMElement &$element, $attributes, $exclude = '') {
    if (!is_array($attributes)) $attributes = array();

    foreach ($attributes as $name => $value) {
      if ($exclude && $exclude === $name) continue;
      $element->removeAttribute($name);
      $element->setAttribute($name, $value);
    }
  }

  /**
   * Undocumented function
   *
   * @param DOMElement $element
   * @return void
   */
  private function getValue(DOMElement &$element = NULL) {
    if (!$element) return NULL;
    return $element->textContent;
  }

  /**
   * Undocumented function
   *
   * @param DOMElement $element
   * @param string $attrName
   * @return string
   */
  private function getValueAttribute(DOMElement &$element = NULL, $attrName) {
    if (!$element) return NULL;
    return $element->getAttribute($attrName);
  }

  /**
   * Undocumented function
   *
   * @param DOMElement[] $array
   * @return array
   */
  private function getValueArray(&$array) {
    if (is_null($array)) $array = array();

    $value = array();
    foreach ($array as $element) {
      $value[] = $element->textContent;
    }

    return $value;
  }

  /**
   * Undocumented function
   *
   * @param DOMElement[] $array
   * @param string $attrName
   * @return array
   */
  private function getValueAttributeArray(&$array, $attrName) {
    if (is_null($array)) $array = array();

    $value = array();
    foreach ($array as $element) {
      $value[] = $element->getAttribute($attrName);
    }

    return $value;
  }

  /**
   * Undocumented function
   *
   * @param DOMElement $root
   * @param DOMElement $element
   * @param string $tagName
   * @param string $value
   * @param array $attributes
   * @return void
   */
  private function setValue(DOMElement &$root, DOMElement &$element = NULL, $tagName, $value, $attributes = array(), $cdata = false) {
    if (!is_bool($cdata)) $cdata = false;
    if ($element) $root->removeChild($element);
    
    if ($cdata) {
      $content = $this->dom->createCDATASection($value);
      $element = $this->dom->createElement($tagName);
      $element->appendChild($content);
    } else {
      $element = $this->dom->createElement($tagName, $value);
    }

    $this->setExtraAttributes($element, $attributes);
    $root->appendChild($element);
  }

  /**
   * Undocumented function
   *
   * @param DOMElement $element
   * @param string $tagName
   * @param string $value
   * @param array $attributes
   * @return void
   */
  private function setValueToRoot(DOMElement &$element = NULL, $tagName, $value, $attributes = array(), $cdata = false) {
    $this->setValue($this->root, $element, $tagName, $value, $attributes, $cdata);
  }

  /**
   * Undocumented function
   *
   * @param DOMElement $root
   * @param DOMElement $element
   * @param string $tagName
   * @param string $attrName
   * @param string $value
   * @param array $attributes
   * @return void
   */
  private function setValueAttribute(DOMElement &$root, DOMElement &$element = NULL, $tagName, $attrName, $value, $attributes = array()) {
    if ($element) $root->removeChild($element);
    $element = $this->dom->createElement($tagName);
    $this->setExtraAttributes($element, $attributes, $attrName);
    $element->setAttribute($attrName, $value);
    $root->appendChild($element);
  }

  /**
   * Undocumented function
   *
   * @param DOMElement $element
   * @param string $tagName
   * @param string $attrName
   * @param string $value
   * @param array $attributes
   * @return void
   */
  private function setValueAttributeToRoot(DOMElement &$element = NULL, $tagName, $attrName, $value, $attributes = array()) {
    $this->setValueAttribute($this->root, $element, $tagName, $attrName, $value, $attributes);
  }

  /**
   * Undocumented function
   *
   * @param DOMElement $root
   * @param DOMElement[] $array
   * @param string $tagName
   * @param string $value
   * @param array $attributes
   * @return void
   */
  private function &addValue(DOMElement &$root, &$array, $tagName, $value, $attributes = array(), $cdata = false) {
    if (!is_bool($cdata)) $cdata = false;
    if (is_null($array)) $array = array();

    for ($i = 0; $i < count($array); $i++) {
      if ($array[$i]->textContent === $value) {
        $root->removeChild($array[$i]);
        array_splice($array, $i, 1);
        break;
      }
    }

    if ($cdata) {
      $content = $this->dom->createCDATASection($value);
      $element = $this->dom->createElement($tagName);
      $element->appendChild($content);
    } else {
      $element = $this->dom->createElement($tagName, $value);
    }

    $this->setExtraAttributes($element, $attributes);

    $root->appendChild($element);
    $array[] = &$element;

    return $element;
  }

  /**
   * Undocumented function
   *
   * @param DOMElement[] $array
   * @param string $tagName
   * @param string $value
   * @param array $attributes
   * @return void
   */
  private function &addValueToRoot(&$array, $tagName, $value, $attributes = array(), $cdata = false) {
    return $this->addValue($this->root, $array, $tagName, $value, $attributes, $cdata);
  }

  /**
   * Undocumented function
   *
   * @param DOMElement $root
   * @param DOMElement[] $array
   * @param string $tagName
   * @param string $attrName
   * @param string $value
   * @param array $attributes
   * @return void
   */
  private function &addValueAttribute(DOMElement &$root, &$array, $tagName, $attrName, $value, $attributes = array()) {
    if (is_null($array)) $array = array();

    for ($i = 0; $i < count($array); $i++) {
      if ($array[$i]->getAttribute($attrName) === $value) {
        $root->removeChild($array[$i]);
        array_splice($array, $i, 1);
        break;
      }
    }

    $element = $this->dom->createElement($tagName);
    $this->setExtraAttributes($element, $attributes);
    $element->setAttribute($attrName, $value);

    $root->appendChild($element);
    $array[] = &$element;

    return $element;
  }

  /**
   * Undocumented function
   *
   * @param DOMElement[] $array
   * @param string $tagName
   * @param string $attrName
   * @param string $value
   * @param array $attributes
   * @return void
   */
  private function &addValueAttributeToRoot(&$array, $tagName, $attrName, $value, $attributes = array()) {
    return $this->addValueAttribute($this->root, $array, $tagName, $attrName, $value, $attributes);
  }

  private function ensureParentElement(DOMElement &$element = NULL, $tagName, $attributes = array()) {
    if (!$element) {
      $element = $this->dom->createElement($tagName);
      $this->setExtraAttributes($element, $attributes);
      $this->root->appendChild($element);
    }
  }

}
