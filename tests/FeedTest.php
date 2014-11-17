<?php

use SocialStreamCombine\Feed;

class FeedTests extends \PHPUnit_Framework_TestCase
{
	/**
	 *
	 */
	public function testFeed()
	{
		$feed = new Feed();
		$this->assertTrue(is_object($feed),"Feed should be an object;-)");
	}
}
