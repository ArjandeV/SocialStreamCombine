<?php
namespace SocYolo\Providers;

use SocYolo\AbstractProvider as AbstractProvider;

class Googleplus extends AbstractProvider
{
	protected $required = ['channelName', 'apiKey'];

	protected $settings;

	/**
	 * {@inheritDocs}
	 */
	public function getFeed($limit = null)
	{
		$appID = $this->settings['appID'];
		$appSecret = $this->settings['appSecret'];
		$feed = $this->settings['user_id'];
		$maximum = 10;

		$authentication = file_get_contents("https://graph.facebook.com/oauth/access_token?grant_type=client_credentials&client_id={$appID}&client_secret={$appSecret}");
		$response = file_get_contents("https://graph.facebook.com/{$feed}/posts?{$authentication}&limit={$maximum}");

		return $this->filterInput($response);
	}

	protected function normalizeItem(array $response)
	{
		$date = new DateTime($item['created_at']);
		return [
			'date' => $date->format("Y-m-d H:i:s"),
			'content' => substr($item['message'], 0, 140),
			'url' => $item['link'],
		];
	}
}
