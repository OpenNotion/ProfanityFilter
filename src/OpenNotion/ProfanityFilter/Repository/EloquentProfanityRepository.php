<?php

namespace OpenNotion\ProfanityFilter\Repository;

use OpenNotion\ProfanityFilter\Model\Profanity;

/**
 * An Eloquent implementation of the ProfanityRepositoryInterface.
 *
 * @package OpenNotion\ProfanityFilter
 */
class EloquentProfanityRepository implements ProfanityRepositoryInterface
{
	/**
	 * Retrieve all profanities in the form of an array listing profanity => replacement.
	 *
	 * @return array
	 */
	public function getProfanities()
	{
		return Profanity::lists('replacement', 'profanity');
	}

	/**
	 * Create a new profanity.
	 *
	 * @param string $profanity   The profanity keyword to search for.
	 * @param string $replacement The replacement to use for the profanity.
	 *
	 * @return mixed|null Object representing the profanity if the storage mechanism supports such.
	 */
	public function create($profanity = '', $replacement = '')
	{
		$profanity = Profanity::create(
			array(
				'profanity'   => (string) $profanity,
				'replacement' => (string) $replacement,
			)
		);

		return $profanity;
	}

	/**
	 * Update an existing profanity.
	 *
	 * @param int    $id          The ID of the profanity to update.
	 * @param string $profanity   The profanity keyword to search for.
	 * @param string $replacement The replacement to use for the profanity.
	 *
	 * @return mixed|null Object representing the profanity if the storage mechanism supports such.
	 */
	public function update($id = 0, $profanity = '', $replacement = '')
	{
		$profanity = Profanity::find((int) $id);

		if ($profanity) {
			$profanity->profanity   = (string) $profanity;
			$profanity->replacement = (string) $replacement;
			$profanity->save();
		}

		return $profanity;
	}
}
