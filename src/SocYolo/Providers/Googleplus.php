<?php
namespace SocYolo\Providers;

use SocYolo\AbstractProvider as AbstractProvider;

class Googleplus extends AbstractProvider
{
	protected $required = ['user_id', 'apiKey'];

	protected $settings;

	/**
	 * {@inheritDocs}
	 */
	public function getFeed($limit = null)
	{
		$user_id = $this->settings['user_id'];
		$apiKey = $this->settings['apiKey'];

		$response = file_get_contents("https://www.googleapis.com/plus/v1/people/{$user_id}/activities/public?key={$apiKey}");
		return $this->filterInput($response);
	}

	protected function normalizeItem(array $response)
	{
		$date = new DateTime($item->created_at);
		return [
			'date' => $date->format("Y-m-d H:i:s"),
			'content' => substr($item['object']['content'],0,140),
			'url' => $item->url,
		];
	}
}
