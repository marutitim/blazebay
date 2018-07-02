<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH.'libraries\vendor\autoload.php');

class Main extends CI_Controller {


	public function index()
	{
		$client = new GuzzleHttp\Client();
		$res = $client->request('GET', 'http://api.blazesacco.com/members/api/v1/members/member/', [
		    'auth' => ['user', 'pass']
		]);
		echo $res->getStatusCode();
		// "200"
		echo "<br>";
		echo $res->getBody();
	}
}
