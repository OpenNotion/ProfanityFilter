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
	/**
	 * Whether to use the leet speak replacement functionality to expand standard profanity filters to try and capture leet speak.
	 * For this to work, make sure that the leet_speak configuration file has the replacements defined for each letter you wish to replace.
	 */
	'use_leet_speak_replacement' => true,
);
