<?php

namespace SocialStreamCombine;

interface CacheInterface
{
	public function __construct($key, $lifetime);

	public function get($limit);

	public function store($limit, $data);
}
