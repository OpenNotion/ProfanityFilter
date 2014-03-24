<?php

namespace OpenNotion\ProfanityFilter\Service;

/**
 * Contract for a caching service.
 *
 * @package OpenNotion\ProfanityFilter
 */
interface CacheServiceInterface
{
	/**
	 * Check if the cache contains a key.
	 *
	 * @param string $key The key to test for.
	 *
	 * @return bool Whether the item exists in the cache.
	 */
	public function has($key = '');

	/**
	 * Get the value for a key from the cache.
	 *
	 * @param string $key The key to fetch the contents for.
	 *
	 * @return mixed The content found within the cache.
	 */
	public function get($key = '');

	/**
	 * Add a key to the cache.
	 *
	 * @param string $key    The unique key for the data to add to the cache.
	 * @param mixed  $data   The data to add to the cache.
	 * @param int    $expiry The expiry time for the item, in minutes.
	 *
	 * @return void
	 */
	public function put($key = '', $data, $expiry = 0);
} 
