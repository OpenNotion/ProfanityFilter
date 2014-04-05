<?php

namespace OpenNotion\ProfanityFilter\Repository\Decorator;

use OpenNotion\ProfanityFilter\Model\Profanity;

/**
 * ProfanityRepository Decorator that runs preg_quote on all profanities and prefixes them with preg_replace() delimiters.
 *
 * @package OpenNotion\ProfanityFilter
 */
class NoRegexProfanityRepositoryDecorator extends ProfanityRepositoryDecorator
{
	/**
	 * Retrieve all profanities in the form of an array listing search word => replacement.
	 *
	 * @return array
	 */
	public function getProfanities()
	{
		$baseProfanities = $this->profanityRepository->getProfanities();

		$newProfanities = array();

		foreach ($baseProfanities as $profanity => $replacement) {
			$profanity = '#' . preg_quote($profanity, '#') . '#i';

			$newProfanities[$profanity] = $replacement;
		}

		return $newProfanities;
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
		return $this->profanityRepository->create($profanity, $replacement);
	}

	/**
	 * Update an existing profanity.
	 *
	 * @param int    $id          The ID of the profanity to update.
	 * @param string $profanity   The profanity keyword to search for.
	 * @param string $replacement The replacement to use for the profanity.
	 *
	 * @return mixed|null Object representing the profanity if the storage mechanism supports such.
	 *
	 * @throws \BadMethodCallException Thrown if the repository type does not support this method.
	 */
	public function update($id = 0, $profanity = '', $replacement = '')
	{
		return $this->profanityRepository->update($id, $profanity, $replacement);
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
		return $this->profanityRepository->paginateProfanities($perPage);
	}
}
