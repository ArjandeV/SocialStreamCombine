<?php

namespace SocialStreamCombine;

interface ProviderInterface {

	/**
	 * Get a social feed
	 * @param int $limit
	 * @return array
	 */
	public function getFeed($limit = null);

	/**
	 * Get the feed name
	 * @return string feed name
	 */
	public function getName();
}
