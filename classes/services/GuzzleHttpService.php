<?php

namespace Classes\Services;

use \GuzzleHttp\Client;

/** Guzzle service is a wrapper of Guzzle HTTP package to make it easier to make requests **/
class GuzzleHttpService
{
	private $client;

	public function __construct()
	{
		$this->client = new Client;
	}

	// handles the GET HTTP request
	public function getRequest($request_url)
	{
		$response = $this->client->request('GET', $request_url);

		return [
			'status_code'   => $response->getStatusCode(),
			'status_reason' => $response->getReasonPhrase(),
			'body'          => json_decode($response->getBody())
		];
	}

	// TODO implement another functions to handle various http methods and operations ...
}