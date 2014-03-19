<?php

namespace OpenNotion\ProfanityFilter;

/**
 * Tests for the OpenNotion\ProfanityFilter\Filter class.
 *
 * @package OpenNotion\ProfanityFilter
 */
class FilterTest extends \TestCase
{
	public function testSimpleReplaceUsingConfig()
	{
		/** @var \OpenNotion\ProfanityFilter\Filter $filter */
		$filter = $this->app->make('profanities');

		$expected = '**** this!';

		$actual = $filter->replaceProfanities('fuck this!');

		$this->assertEquals($expected, $actual);
	}

	public function testReplaceWithLeetUsingConfig()
	{
		/** @var \OpenNotion\ProfanityFilter\Filter $filter */
		$filter = $this->app->make('profanities');

		$expected = '**** this!';

		$actual = $filter->replaceProfanities('ƒu.¢k this!');

		$this->assertEquals($expected, $actual);
	}
}
