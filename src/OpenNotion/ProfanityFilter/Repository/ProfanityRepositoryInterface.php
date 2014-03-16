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
} 
