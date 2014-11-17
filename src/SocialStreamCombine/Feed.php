<?php

namespace SocialStreamCombine;

use \Guzzle\Http\Client;

class Feed
{
	protected $cache;
	protected $cachekey;
	protected $guzzle;
	protected $feeds = [];

	public function __construct(Client $guzzle, array $feeds = [], CacheInterface $cache = null, $cachekey = 'social-feeds')
	{
		array_map([$this, 'registerProvider'], $feeds);
		$this->setGuzzleClient($guzzle);
		$this->setCache($cache ?: new Cache\Noop($cachekey, null));
		$this->setCacheKey($cachekey);
	}

	public function getFeeds($limit = null)
	{
		if ($cached = $this->getCachedFeeds($limit)) {
			return $cached;
		}

		$response = [];

		foreach ($this->feeds as $feed) {
			$response = array_merge($response, $feed->getFeed());
		}

		usort($response, [$this, 'compareTimestamp']);

		$this->cacheFeeds($response, $limit);

		return $response;
	}

	public function setGuzzleClient(Client $client)
	{
		$this->guzzle = $client;
	}

	public function setCache(CacheInterface $cache)
	{
		$this->cache = $cache;

		return $this;
	}

	public function setCacheKey($key)
	{
		$this->cachekey = $key;

		return $this;
	}

	protected function getCachedFeeds($limit)
	{
		return $this->cache->get($this->cachekey . $limit);
	}

	protected function cacheFeeds($response, $limit)
	{
		$this->cache->store($this->cachekey . $limit, $response);
	}

	public function registerProvider(ProviderInterface $provider)
	{
		$provider->setGuzzleClient($this->guzzle);
		$this->feeds[] = $provider;
	}

	protected function compareTimestamp(array $a, array $b)
	{
		$atime = $a['date']->getTimestamp();
		$btime = $b['date']->getTimestamp();

		return $atime - $btime;
	}
}
