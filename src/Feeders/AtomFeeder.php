<?php
namespace SimpleFeeder\Feeders;

use SimpleFeeder\Core\Feeder;
use SimpleFeeder\Entries\AtomFeederEntry;
use SimpleFeeder\Traits\UsesDomReaderWriter;

class AtomFeeder extends Feeder {

  use UsesDomReaderWriter;

  protected $entryType = AtomFeederEntry::class;
  
}
