<?php

namespace SocYolo;

use Guzzle\Http\Client as GuzzleClient;

abstract class AbstractProvider implements ProviderInterface
{
	protected $required = [];
	protected $guzzle;
	protected $name;

	public function __construct(array $settings) 
	{
		$this->setCredentials($settings);
	}

	public function setGuzzleClient(GuzzleClient $client)
	{
		$this->guzzle = $client;

		return $this;
	}

	public function getName()
	{
		if ( ! $this->name) {
			throw new \LogicException('A feed provider should have a name');
		}

		return $this->name;
	}

	public function setCredentials(array $settings)
	{
		$this->validateCredentials($settings);
		$this->settings = $settings;
	}

	public function validateCredentials(array $settings)
	{
		foreach ($this->required as $field) {
			if ( ! isset($settings[$field])) {
				throw new MissingConfigException(get_class($this) . ' needs a ' . $field);
			}
		}
	}

	protected function filterInput($json_response)
	{
		$response = json_decode($json_response, true);
		$responses = array_map([$this, 'normalizeItem'], $response);

		return array_map([$this, 'setProviderType'], $responses);
	}

	protected function setProviderType(array $response)
	{
		$response['provider'] = $this->getName();

		return $response;
	}

	abstract protected function normalizeItem(array $item);

}