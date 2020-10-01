<?php

namespace App\Helpers;
use GuzzleHttp\Client;

class CurlHelper
{
	public static function send($url, $data) {

		$client = new Client([
		    'headers' => [ 'Content-Type' => 'application/json' ]
		]);

		$response = $client->post($url,
		    ['body' => $data]
		);

		return $response;
	}

	public static function post($url, $data, $headers = null) {

		$client = new Client([
		    'headers' => $headers
		]);

		$response = $client->post($url,
		    ['body' => $data]
		);

		return $response;
	}

	public static function get($url, $data, $headers = null) {

		$client = new Client([
		    'headers' => $headers
		]);

		$response = $client->get($url,
		    ['query' => $data]
		);

		return $response;
	}

}
?>