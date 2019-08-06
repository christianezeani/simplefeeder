<?php
namespace SimpleFeeder\Traits;

trait CanReadAndWriteFeed {

  use CanReadFeed;

  /**
   * Returns a string to be saved or rendered
   *
   * @return string
   */
  public function toString() {
    return '';
  }

  protected function onBeforeRender() {
    // Not yet implemented
  }


  public function save(string $filename) {
    $data = $this->toString();

    $directory = dirname($filename);
    if (!empty($directory) && !is_dir($directory)) {
      mkdir($directory, 0777, true);
    }

    if ($handle = fopen($filename, 'w')) {
      fwrite($handle, $data);
      fclose($handle);
    }
  }

  public function render() {
    $this->onBeforeRender();
    echo $this->toString();
    exit;
  }

}
