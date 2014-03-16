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
}
