<?php
namespace SocialStreamCombine\Providers;

use SocialStreamCombine\AbstractProvider as AbstractProvider;

class Googleplus extends AbstractProvider
{
	protected $required = ['channelName', 'apiKey'];

	protected $settings;

	/**
	 * {@inheritDocs}
	 */
	public function getFeed($limit = null)
	{
		$channelName = $this->settings['channelName'];
		$apiKey = $this->settings['apiKey'];

		$response = file_get_contents("http://gdata.youtube.com/feeds/api/users/{$channelName}/uploads?alt=json&key={$apiKey}");
		return $this->filterInput($response);
	}

	protected function normalizeItem(array $response)
	{
		$date = new DateTime($item['created_at']);
		return [
			'date' => $date->format("Y-m-d H:i:s"),
			'content' => substr($item['title']['$t'], 0, 140),
			'url' => $item['link'][0]['href'],
		];
	}
}
