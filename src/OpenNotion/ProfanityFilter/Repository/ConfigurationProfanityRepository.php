<?php

namespace OpenNotion\ProfanityFilter\Repository;

use Illuminate\Config\Repository as Config;

/**
 * An implementation of the ProfanityRepositoryInterface using a configuration file to fetch profanities.
 *
 * @package OpenNotion\ProfanityFilter
 */
class ConfigurationProfanityRepository implements ProfanityRepositoryInterface
{
	/** @var \Illuminate\Config\Repository $config */
	protected $config;

	/**
	 * Create a new instance of the repository sing the given configuration repository.
	 *
	 * @param Config $config The config repository to use.
	 */
	public function __construct(Config $config)
	{
		$this->config = $config;
	}

	/**
	 * Retrieve all profanities in the form of an array listing search word => replacement.
	 *
	 * @return array
	 */
	public function getProfanities()
	{
		return $this->config->get('profanity-filter::profanities');
	}
}
