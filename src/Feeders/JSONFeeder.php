<?php
namespace SimpleFeeder\Feeders;

use SimpleFeeder\Core\Feeder;
use SimpleFeeder\Entries\JSONFeederEntry;

class JSONFeeder extends Feeder {

  protected $entryType = JSONFeederEntry::class;
  
}
