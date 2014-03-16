<?php

return array(
	/**
	 * The source to load profanity replacements from. Can be one of 'config' or 'database'.
	 * To use the database source, you must first run the package migrations.
	 */
	'source' => 'config',
	/**
	 * If you're using the database source, you can use caching to improve the performance of the filter.
	 */
	'cache'  => array(
		/**
		 * Whether to enable caching of profanity filter settings.
		 */
		'enabled' => true,
		/**
		 * The key to use in the cache to store the profanities.
		 */
		'key'     => 'opennotion.profanities'
	),
);
