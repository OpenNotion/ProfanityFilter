<?php

namespace OpenNotion\ProfanityFilter\Repository\Decorator;

use OpenNotion\ProfanityFilter\Repository\ProfanityRepositoryInterface;
use OpenNotion\ProfanityFilter\Service\CacheServiceInterface;

/**
 * Caching decorator for the profanity repository.
 *
 * @package OpenNotion\ProfanityFilter
 */
class CacheProfanityRepositoryDecorator extends ProfanityRepositoryDecorator
{
	/** @var \OpenNotion\ProfanityFilter\Service\CacheServiceInterface $cache */
	protected $cache;
	/** @var string $cacheKey */
	protected $cacheKey;

	/**
	 * Create a new instance of the caching decorator.
	 *
	 * @param ProfanityRepositoryInterface $profanityRepository The repository to decorate.
	 * @param CacheServiceInterface        $cache               A caching service instance.
	 * @param string                       $cacheKey            The key to use to store profanities in.
	 */
	public function __construct(
		ProfanityRepositoryInterface $profanityRepository,
		CacheServiceInterface $cache,
		$cacheKey = 'opennotion.profanities'
	) {
		parent::__construct($profanityRepository);

		$this->cache    = $cache;
		$this->cacheKey = $cacheKey;
	}

	/**
	 * Retrieve all profanities in the form of an array listing search word => replacement.
	 *
	 * @return array
	 */
	public function getProfanities()
	{
		if ($this->cache->has($this->cacheKey)) {
			return $this->cache->get($this->cacheKey);
		}

		$profanities = $this->profanityRepository->getProfanities();

		$this->cache->put($this->cacheKey, $profanities);

		return $profanities;
	}
}
