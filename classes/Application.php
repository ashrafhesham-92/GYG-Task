<?php

namespace Classes;

use Classes\Services\GuzzleHttpService;
use Classes\Helpers\Functions;

class Application
{
	private $args; // arguments passed from the cli
	private $config; // application configuartion array

	// constants defining the way to retrieve data so the handle() function deals based on it
	private const API_MODE = 'API';
	private const DB_MODE  = 'DATABASE';

	public function __construct(array $args, array $config)
	{
		$this->args    = $args;
		$this->config  = $config;
	}

	// handles the application logic
	public function handle()
	{
		if($this->config['retrieve_mode'] == self::API_MODE)
		{

			// validates arguments passed from the cli
			$this->validateArguments();

			// gets the data from the API link
			$retrieved_data = $this->getData($this->config['api_urls']['get_data']);

			$filtered_data = $this->filterData($retrieved_data['body']->product_availabilities);

			return $filtered_data;
		}
		else
		{
			// handle another type of retrieving data
		}
	}

	private function getData($request_url)
	{
		// instantiates object of the custom guzzle service
		$guzzle_service = new GuzzleHttpService;

		// gets the response data after making the request to the API
		$response = $guzzle_service->getRequest($request_url);

		if($response['status_code'] != 200)
		{
			throw new \Exception('Error retrieving data!');
		}

		return $response;
	}

	// validates the arguments passed from the cli
	private function validateArguments()
	{
		$start_time     = $this->args[1]??false;
		$end_time       = $this->args[2]??false;
		$travellers_num = $this->args[3]??false;

		if(!$start_time || !$end_time || !$travellers_num)
		{
			throw new \Exception("Missing required arguments");
		}

		if(Functions::validDateTime($this->args[1], 'Y-m-d\TH:i') === false)
		{
			throw new \Exception("Invalid start date-time format");
		}

		if(Functions::validDateTime($this->args[2], 'Y-m-d\TH:i') === false)
		{
			throw new \Exception("Invalid end date-time format");
		}

		if(Functions::validInteger($this->args[3]) === 0)
		{
			throw new \Exception("Invalid travellers number format");
		}
	}

	private function filterData($data)
	{
		$available_times = [];

		$start_time     = $this->args[1];
		$end_time       = $this->args[2];
		$travellers_num = $this->args[3];

		foreach($data as $product_data)
		{
			if($product_data->activity_start_datetime >= $start_time && $product_data->activity_start_datetime < $end_time && $product_data->places_available >= $travellers_num)
			{
				$available_times[$product_data->product_id]['product_id'] = $product_data->product_id;
				$available_times[$product_data->product_id]['available_starttimes'][] = $product_data->activity_start_datetime;

				// sorting the times
				sort($available_times[$product_data->product_id]['available_starttimes']);
			}
		}

		// sorting the final filtered data
		sort($available_times);

		return json_encode($available_times, JSON_PRETTY_PRINT);
	}
}