<?php
namespace SimpleFeeder;

use SimpleFeeder\Exceptions\InvalidFeederException;

use SimpleFeeder\Feeders\RSSFeeder;
use SimpleFeeder\Feeders\AtomFeeder;
use SimpleFeeder\Feeders\JSONFeeder;
use SimpleFeeder\Feeders\SitemapFeeder;
use SimpleFeeder\Feeders\SitemapIndexFeeder;

class SimpleFeeder {

  private static $types = [
    'rss' => RSSFeeder::class,
    'atom' => AtomFeeder::class,
    'json' => JSONFeeder::class,
    'sitemap' => SitemapFeeder::class,
    'sitemapIndex' => SitemapIndexFeeder::class
  ];

  private $feeder;

  /**
   * @param string $type Feeder Type
   * @param mixed $data Data to be parsed
   */
  function __construct($type, $data=NULL) {
    $this->feeder = self::feeder($type, $data);
  }

  public static function feeder(string $type, $data=NULL) {
    if (!array_key_exists($type, self::$types)) {
      $allowed = implode(', ', array_keys(self::$types));
      $message = 'Invalid feeder specified! Allowed feeders include "'.$allowed.'".';
      throw new InvalidFeederTypeException($message);
    }

    $feeder = self::$types[$type];

    return new $feeder($data);
  }

  public function __call($method, $parameters) {
    return $this->feeder->{$method}(...$parameters);
  }

  public function __get($name) {
    return $this->feeder->{$name};
  }

  public function __set($name, $value) {
    $this->feeder->{$name} = $value;
  }

  public function __invoke(...$args) {
    $feeder = &$this->feeder;
    return $feeder(...$args);
  }
  
}
