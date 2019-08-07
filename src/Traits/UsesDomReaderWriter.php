<?php
namespace SimpleFeeder\Traits;

use DOMDocument;
use SimpleFeeder\Exceptions\NotImplementedException;

trait UsesDomReaderWriter {

  use UsesDomFunctions;

  /**
   * Called after DOM has been initialized.
   * 
   * This is usually the appropriate time to create document root
   * and set DOM Attributes.
   *
   * @return void
   */
  protected function onDomReady() {
    $message = '"'.__METHOD__.'" has not been implemented in "'.__CLASS__.'".';
    throw new NotImplementedException($message);
  }

  protected function initialize() {
    $this->dom = new DOMDocument();
    $this->dom->version = '1.0';
    $this->dom->encoding = 'UTF-8';
    $this->onDomReady();
  }

  public function toString() {
    return $this->dom->saveXML();
  }

}
