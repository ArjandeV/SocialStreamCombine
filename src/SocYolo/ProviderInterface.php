<?php

namespace SocYolo;

interface ProviderInterface {

	/**
	 * Get a social feed
	 * 
	 * @return array
	 */
	public function getFeed($limit = null);

	/**
	 * Get the feed name
	 * @return string feed name
	 */
	public function getName();
}