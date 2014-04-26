<?php

namespace OpenNotion\ProfanityFilter;

use OpenNotion\ProfanityFilter\Repository\AbstractProfanityRepository;
use OpenNotion\ProfanityFilter\Repository\ProfanityRepositoryInterface;

/**
 * Profanity filter - performs a replacement of defined "profanities" in blocks of text.
 *
 * @package OpenNotion\ProfanityFilter
 */
class Filter
{
    /** @var \OpenNotion\ProfanityFilter\Repository\ProfanityRepositoryInterface $profanityRepository */
    protected $profanityRepository;
    /** @var array $profanities */
    protected $profanities;

    /**
     * Initialise a new profanity filter instance with the given profanity source.
     *
     * @param ProfanityRepositoryInterface $profanityRepository The repository to act as a source of profanities and replacements.
     */
    public function __construct(ProfanityRepositoryInterface $profanityRepository)
    {
        $this->profanityRepository = $profanityRepository;
    }

    /**
     * Set the repository used to load profanities.
     *
     * @param \OpenNotion\ProfanityFilter\Repository\ProfanityRepositoryInterface $profanityRepository
     */
    public function setProfanityRepository(ProfanityRepositoryInterface $profanityRepository)
    {
        $this->profanityRepository = $profanityRepository;
    }

    /**
     * Get the repository used to load profanities.
     *
     * @return \OpenNotion\ProfanityFilter\Repository\ProfanityRepositoryInterface
     */
    public function getProfanityRepository()
    {
        return $this->profanityRepository;
    }

    /**
     * Load the profanities from the set source into the class variable $profanities to save future requests to load profanities.
     */
    protected function loadProfanities()
    {
        $this->profanities = $this->profanityRepository->getProfanities();
    }

    /**
     * Replace all of the found profanities within a block of text.
     *
     * @param string $text The text to replace the profanities within.
     *
     * @return string The filtered text.
     */
    public function replaceProfanities($text = '')
    {
        if (!is_array($this->profanities)) {
            $this->loadProfanities();
        }

        $text = (string) $text;

        if (empty($text)) {
            return '';
        }

        return preg_replace(array_keys($this->profanities), array_values($this->profanities), $text);
    }
} 
