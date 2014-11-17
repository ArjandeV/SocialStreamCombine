<?php
date_default_timezone_set('Europe/Amsterdam');
use SocialStreamCombine\Feed;

class FeedTest extends \PHPUnit_Framework_TestCase
{
	/**
	 *
	 */
	public function test_newFeed()
	{
		$guzzleMock = $this->getMock('\Guzzle\Http\Client');
		$feed       = new Feed($guzzleMock);
		$this->assertTrue(is_object($feed), "Feed should be an object");
	}


	public function test_getFeeds()
	{
		$guzzleMock = $this->getMock('\Guzzle\Http\Client');
		$feed       = new Feed($guzzleMock);
		$this->assertCount(10,$feed->getFeeds(10));
	}
}
