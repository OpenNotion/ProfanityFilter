<?php

namespace OpenNotion\ProfanityFilter\Repository\Decorator;

use OpenNotion\ProfanityFilter\Repository\Profanity;
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

	/**
	 * Create a new profanity.
	 *
	 * @param string $profanity   The profanity keyword to search for.
	 * @param string $replacement The replacement to use for the profanity.
	 *
	 * @return mixed|null Object representing the profanity if the storage mechanism supports such.
	 *
	 * @throws \BadMethodCallException Thrown if the repository type does not support this method.
	 */
	public function create($profanity = '', $replacement = '')
	{
		$this->profanityRepository->create($profanity, $replacement);

		$profanities = $this->profanityRepository->getProfanities();

		$this->cache->put($this->cacheKey, $profanities);
	}

	/**
	 * Update an existing profanity.
	 *
	 * @param int    $id          The ID of the profanity to update.
	 * @param string $profanity   The profanity keyword to search for.
	 * @param string $replacement The replacement to sue for the profanity.
	 *
	 * @return mixed|null Object representing the profanity if the storage mechanism supports such.
	 *
	 * @throws \BadMethodCallException Thrown if the repository type does not support this method.
	 */
	public function update($id = 0, $profanity = '', $replacement = '')
	{
		$this->profanityRepository->update($id, $profanity, $replacement);

		$profanities = $this->profanityRepository->getProfanities();

		$this->cache->put($this->cacheKey, $profanities);
	}

	/**
	 * Retrieve a single profanity by it's ID.
	 *
	 * @param int $id The ID of the profanity to fetch.
	 *
	 * @return Profanity
	 */
	public function getProfanity($id = 0)
	{
		return $this->profanityRepository->getProfanity($id);
	}

	/**
	 * Get a paginated list of profanity objects.
	 *
	 * @param int $perPage The number of profanities per page.
	 *
	 * @return \Illuminate\Pagination\Paginator A paginator instance.
	 */
	public function paginateProfanities($perPage = 10)
	{
		if ($this->cache->has($this->cacheKey . '.paginated')) {
			return $this->cache->get($this->cacheKey . '.paginated');
		}

		$profanities = $this->profanityRepository->paginateProfanities();

		$this->cache->put($this->cacheKey . '.paginated', $profanities);

		return $profanities;
	}
}
