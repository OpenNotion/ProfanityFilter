<?php

namespace OpenNotion\ProfanityFilter\Repository\Decorator;

use OpenNotion\ProfanityFilter\Repository\ProfanityRepositoryInterface;

/**
 * Profanity Repository decorator that changes profanity filters into regex patterns to try and filter "Leet Speak".
 *
 * @package OpenNotion\ProfanityFilter
 */
class LeetSpeakProfanityRepositoryDecorator extends ProfanityRepositoryDecorator
{
	/** @var array $leetReplacements */
	private $leetReplacements;

	/**
	 * Create a new instance of the "Leet Speak" decorator.
	 *
	 * @param ProfanityRepositoryInterface $profanityRepository The profanity repository instance to decorate.
	 * @param array                        $leetReplacements    An array of letter replacements to be used to filter "Leet Speak".
	 */
	public function __construct(ProfanityRepositoryInterface $profanityRepository, array $leetReplacements)
	{
		parent::__construct($profanityRepository);

		$this->leetReplacements = $leetReplacements;
	}

	/**
	 * Retrieve all profanities in the form of an array listing search word => replacement.
	 *
	 * @return array
	 */
	public function getProfanities()
	{
		$profanities = $this->profanityRepository->getProfanities();

		$formattedProfanities = array();

		foreach ($profanities as $profanity => $replacement) {
			$formattedProfanities[$this->replaceProfanityCharacters($profanity)] = $replacement;
		}

		return $formattedProfanities;
	}

	/**
	 * Replace the characters within a profanity string with their character replacements to circumvent "Leet" speak.
	 *
	 * @param string $profanity The profanity to replace the characters within.
	 *
	 * @return string The new profanity string to search for.
	 */
	protected function replaceProfanityCharacters($profanity)
	{
		$profanity = (string) $profanity;

		$newProfanity = '#' . str_ireplace(
				array_keys($this->leetReplacements),
				array_values($this->leetReplacements),
				$profanity
			) . '#i';

		return $newProfanity;
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
}
