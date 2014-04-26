<?php

namespace OpenNotion\ProfanityFilter\Repository;

use Illuminate\Config\Repository as Config;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use OpenNotion\ProfanityFilter\Model\Profanity;

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

	/**
	 * Create a new profanity.
	 *
	 * @param string $profanity   The profanity keyword to search for.
	 * @param string $replacement The replacement to use for the profanity.
	 *
	 * @return mixed|null Object representing the profanity if the storage mechanism supports such.
	 *
	 * @throws \BadMethodCallException
	 */
	public function create($profanity = '', $replacement = '')
	{
		throw new \BadMethodCallException('The Configuration repository provider does not support the creating or updating of profanities.');
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
	 * @throws \BadMethodCallException
	 */
	public function update($id = 0, $profanity = '', $replacement = '')
	{
		throw new \BadMethodCallException('The Configuration repository provider does not support the creating or updating of profanities.');
	}

	/**
	 * Retrieve a single profanity by it's ID.
	 *
	 * @param int $id The ID of the profanity to fetch.
	 *
	 * @return Profanity
	 *
	 * @throws \BadMethodCallException
	 */
	public function getProfanity($id = 0)
	{
		throw new \BadMethodCallException('The Configuration repository provider does not support the fetching of single profanities.');
	}

	/**
	 * Get a paginated list of profanity objects.
	 *
	 * @param int $perPage The number of profanities per page.
	 *
	 * @return \Illuminate\Pagination\Paginator A paginator instance.
     *
     * @throws \BadMethodCallException
	 */
    public function paginateProfanities($perPage = 10)
	{
        throw new \BadMethodCallException('The Configuration repository provider does not support the pagination of profanities.');
	}

    /**
     * Delete a profanity from the system.
     *
     * @param int $id The ID of the profanity to delete.
     *
     * @return bool Whether the profanity was deleted.
     *
     * @throws \BadMethodCallException Thrown if the repository type does not support this method.
     * @throws ModelNotFoundException Thrown if no profanity with the given ID is found.
     */
    public function deleteProfanity($id = 0)
    {
        throw new \BadMethodCallException('The Configuration repository provider does not support the deletion of profanities.');
    }
}
