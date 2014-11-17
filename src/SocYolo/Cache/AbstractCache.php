<?php

namespace SocYolo\Cache;

use SocYolo\CacheInterface;

abstract class AbstractCache implements CacheInterface
{
	protected $key;
	protected $lifetime;

	public function __construct($key, $lifetime)
	{
		$this->key = $key;
		$this->lifetime = $lifetime;
	}
}