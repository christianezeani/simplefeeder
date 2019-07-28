<?php
namespace SimpleFeeder\Feeders;

use SimpleFeeder\Core\Feeder;
use SimpleFeeder\Entries\SitemapFeederEntry;
use SimpleFeeder\Traits\UsesDomReaderWriter;

class SitemapFeeder extends Feeder {

  use UsesDomReaderWriter;

  protected $entryType = SitemapFeederEntry::class;
  
}
