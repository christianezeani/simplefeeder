<?php
namespace SimpleFeeder\Feeders;

use SimpleFeeder\Entries\RSSFeederEntry;
use SimpleFeeder\Traits\UsesDomReaderWriter;

use SimpleFeeder\Core\Feeder;

class RSSFeeder extends Feeder {

  use UsesDomReaderWriter;
  
  protected $entryType = RSSFeederEntry::class;

}
