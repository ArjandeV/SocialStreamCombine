<?php

namespace SocYolo\Cache;

use SocYolo\CacheInterface;

class Noop implements CacheInterface
{

	public function __construct($key, $lifetime)
	{
		// never construct anything
	}

	public function get($key)
	{
		// Never get anything
	}

	public function store($key, $data, $lifetime = null)
	{
		// Never store anything
	}
}