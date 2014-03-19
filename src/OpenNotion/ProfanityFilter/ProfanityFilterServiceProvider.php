<?php

namespace OpenNotion\ProfanityFilter;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use OpenNotion\ProfanityFilter\Repository\ConfigurationProfanityRepository;
use OpenNotion\ProfanityFilter\Repository\Decorator\CacheProfanityRepositoryDecorator;
use OpenNotion\ProfanityFilter\Repository\Decorator\LeetSpeakProfanityRepositoryDecorator;
use OpenNotion\ProfanityFilter\Repository\Decorator\NoRegexProfanityRepositoryDecorator;
use OpenNotion\ProfanityFilter\Repository\EloquentAbstractProfanityRepository;

/**
 * ProfanityFilter service provider. handles registering of IOC bindings for the profanity filter.
 *
 * @package OpenNotion\ProfanityFilter
 */
class ProfanityFilterServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('opennotion/profanity-filter');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'\OpenNotion\ProfanityFilter\Service\CacheServiceInterface',
			'\OpenNotion\ProfanityFilter\Service\IlluminateCacheService'
		);

		$this->app->singleton(
			'\OpenNotion\ProfanityFilter\Repository\ProfanityRepositoryInterface',
			function (Application $app) {
				$repository = null;

				/** @var \Illuminate\Config\Repository $config */
				$config = $app->make('config');

				switch ($config->get('profanity-filter::general.source')) {
					case 'database':
						$repository = new EloquentAbstractProfanityRepository();
						break;
					case 'config':
					default:
						$repository = new ConfigurationProfanityRepository($config);
						break;
				}

				if ($config->get('profanity-filter::general.use_leet_speak_replacement')) {
					$leetSpeakReplacements = (array) $config->get('profanity-filter::leet_speak');

					$repository = new LeetSpeakProfanityRepositoryDecorator($repository, $leetSpeakReplacements);
				} else {
					$repository = new NoRegexProfanityRepositoryDecorator($repository);
				}

				if ($config->get('profanity-filter::general.cache.enabled') === true) {
					$cacheKey = (string) $config->get('profanity-filter::general.cache.key');

					$repository = new CacheProfanityRepositoryDecorator($repository, $this->app->make(
						'\OpenNotion\ProfanityFilter\Service\CacheServiceInterface'
					), $cacheKey);
				}

				return $repository;
			}
		);

		$this->app->bind(
			'profanities',
			function ($app) {
				return new Filter($app->make('\OpenNotion\ProfanityFilter\Repository\ProfanityRepositoryInterface'));
			}
		);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('profanities');
	}
}
