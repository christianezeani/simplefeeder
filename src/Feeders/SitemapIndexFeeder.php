<?php
namespace SimpleFeeder\Feeders;

use SimpleFeeder\Core\Feeder;
use SimpleFeeder\Entries\SitemapIndexFeederEntry;
use SimpleFeeder\Traits\UsesDomReaderWriter;

class SitemapIndexFeeder extends Feeder {

  use UsesDomReaderWriter;

  protected $entryType = SitemapIndexFeederEntry::class;

  protected function onDomReady() {
    $this->root = $this->dom->createElement('sitemapindex');
    $this->root->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
    $this->dom->appendChild($this->root);
  }

  protected function onBeforeRender() {
    if (!headers_sent()) {
      header('Content-Type: text/xml');
    }
  }

  protected function newEntryParameters() {
    return array(&$this->dom, &$this->root);
  }
  
}

