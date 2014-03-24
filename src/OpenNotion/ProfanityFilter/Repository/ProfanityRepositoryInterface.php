<?php

namespace OpenNotion\ProfanityFilter\Repository;

/**
 * Contract for a profanity repository that allows the retrieving of profanities.
 *
 * @package OpenNotion\ProfanityFilter
 */
interface ProfanityRepositoryInterface
{
	/**
	 * Retrieve all profanities in the form of an array listing search word => replacement.
	 *
	 * @return array
	 */
	public function getProfanities();

	/**
	 * Retrieve a single profanity by it's ID.
	 *
	 * @param int $id The ID of the profanity to fetch.
	 *
	 * @return Profanity
	 */
	public function getProfanity($id = 0);

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
	public function create($profanity = '', $replacement = '');

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
	public function update($id = 0, $profanity = '', $replacement = '');
} 
