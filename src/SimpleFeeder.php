<?php
namespace SimpleFeeder;

use SimpleFeeder\Exceptions\InvalidFeederException;

use SimpleFeeder\Feeders\RSSFeed;
use SimpleFeeder\Feeders\AtomFeed;
use SimpleFeeder\Feeders\JSONFeed;
use SimpleFeeder\Feeders\Sitemap;
use SimpleFeeder\Feeders\SitemapIndex;

class SimpleFeeder {

  private static $types = [
    'rss' => RSSFeed::class,
    'atom' => AtomFeed::class,
    'json' => JSONFeed::class,
    'sitemap' => Sitemap::class,
    'sitemapIndex' => SitemapIndex::class
  ];

  public static function type(string $type) {
    if (!array_key_exists($type, self::$types)) {
      $allowed = implode(', ', array_keys(self::$types));
      $message = 'Invalid feeder specified! Allowed feeders include "'.$allowed.'".';
      throw new InvalidFeederException($message);
    }

    $feeder = self::$types[$type];

    return new $feeder();
  }

}
