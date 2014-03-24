<?php

namespace OpenNotion\ProfanityFilter\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Profanity Filter Facade class for use with Laravel.
 *
 * @package OpenNotion\ProfanityFilter
 */
class ProfanityFilterFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'profanities';
	}
} 
