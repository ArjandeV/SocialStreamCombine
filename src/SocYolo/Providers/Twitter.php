<?php
namespace SocYolo\Providers;

use SocYolo\AbstractProvider as AbstractProvider;
use Guzzle\Plugin\Oauth\OauthPlugin;

class Twitter extends AbstractProvider
{
	protected $required = ['consumerKey', 'consumerSecret', 'accessToken', 'accessTokenSecret'];

	protected $settings;

	protected $name = 'twitter';
	
	protected $url = 'https://api.twitter.com/1.1/';

	protected $authGuzzle;

	protected function getOAuthGuzzle()
	{
		if ( ! $this->authGuzzle) {
			$this->authGuzzle = clone $this->guzzle;
			$subscriber = $this->getOAuthSubscriber();
			$this->authGuzzle->addSubscriber($subscriber);
		}

		return $this->authGuzzle;
	}

	protected function getOAuthSubscriber()
	{
		$consumerKey = $this->settings['consumerKey'];
		$consumerSecret = $this->settings['consumerSecret'];
		$accessToken = $this->settings['accessToken'];
		$accessTokenSecret = $this->settings['accessTokenSecret'];

		return new OauthPlugin(array(
			'consumer_key' => $consumerKey,
			'consumer_secret' => $consumerSecret,
			'token' => $accessToken,
			'token_secret' => $accessTokenSecret
		));
	}

	/**
	 * {@inheritDocs}
	 */
	public function getFeed($limit = null)
	{
		$client = $this->getOAuthGuzzle();

		$request = $client->get($this->url . 'statuses/user_timeline.json', [
			'screen_name' => $this->settings['username'],
		]);

		try {
			$response = $request->send();
		} catch(\Guzzle\Http\Exception\BadResponseException $e) {
			throw new LogicException;
		}

		return $this->filterInput($response->getBody());
	}

	protected function normalizeItem(array $item)
	{
		$date = new \DateTime($item['created_at']);

		return [
			'date' => $date,
			'content' => $item['text'],
			'url' => 'http://twitter.com/' . $this->settings['username']. '/status/' . $item['id'],
		];
	}
}
