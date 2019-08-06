<?php
namespace SimpleFeeder\Traits;

use SimpleFeeder\Exceptions\NotImplementedException;

trait CanReadFeed {

  use HasEntryCollection;

  public function read(string $input) {
    $message = '"'.__METHOD__.'" has not been implemented in "'.__CLASS__.'".';
    throw new NotImplementedException($message);
  }

}

