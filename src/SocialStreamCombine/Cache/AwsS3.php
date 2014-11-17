<?php

namespace SocialStreamCombine\Cache;

class AwsS3 extends AbstractCache
{
	protected $client;

	public function __construct($key, $lifetime, S3Client $client = null)
	{
		parent::__construct($key, $lifetime);
		$this->setS3Client($client);
	}

	protected function setS3Client(S3Client $client = null)
	{
		if ( ! $client) {
			throw new LogicException(get_class($this) . ' excepts an S3 Client instance as the 3rd constructor argument');
		}

		$this->client = $client;
	}

	public function get($limit)
	{

	}

	public function store($limit, $data)
	{
		
	}
}
