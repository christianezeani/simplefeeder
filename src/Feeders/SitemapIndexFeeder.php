<?php
namespace SimpleFeeder\Feeders;

use SimpleFeeder\Core\Feeder;
use SimpleFeeder\Entries\SitemapIndexFeederEntry;
use SimpleFeeder\Traits\UsesDomReaderWriter;

class SitemapIndexFeeder extends Feeder {

  use UsesDomReaderWriter;

  protected $entryType = SitemapIndexFeederEntry::class;
  
}

