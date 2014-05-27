<?php

namespace OpenNotion\ProfanityFilter\Service;

use Illuminate\Cache\CacheManager;

/**
 * Cache service using the Illuminate cache package.
 *
 * @package OpenNotion\ProfanityFilter
 */
class IlluminateCacheService implements CacheServiceInterface
{
    /** @var \Illuminate\Cache\CacheManager $cache */
    protected $cache;

    /**
     * Create a new instance of the caching service.
     *
     * @param CacheManager $cache An instance of the Laravel CacheManager to use.
     */
    public function __construct(CacheManager $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Check if the cache contains a key.
     *
     * @param string $key The key to test for.
     *
     * @return bool Whether the item exists in the cache.
     */
    public function has($key = '')
    {
        $key = (string) $key;

        return (bool) $this->cache->has($key);
    }

    /**
     * Get the value for a key from the cache.
     *
     * @param string $key The key to fetch the contents for.
     *
     * @return mixed The content found within the cache.
     */
    public function get($key = '')
    {
        $key = (string) $key;

        return $this->cache->get($key);
    }

    /**
     * Add a key to the cache.
     *
     * @param string $key    The unique key for the data to add to the cache.
     * @param mixed  $data   The data to add to the cache.
     * @param int    $expiry The expiry time for the item, in minutes.
     *
     * @return void
     */
    public function put($key = '', $data, $expiry = null)
    {
        $key = (string) $key;

        $this->cache->forever($key, $data, $expiry);
    }

    /**
     * Delete an item from the cache.
     *
     * @param string $key The key of the item to remove.
     */
    public function delete($key = '')
    {
        $this->cache->forget($key);
    }
}
