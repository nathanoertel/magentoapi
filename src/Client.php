<?php
namespace MagentoV1API;

class Client {
	
	private $client;
	
	private $session;
	
	public function __construct($config) {
		if(empty($config['baseUrl']) || empty($config['username']) || empty($config['apiKey'])) {
			throw new \Exception('Client Not Configured');
		} else {
			$this->client = new \SoapClient($config['baseUrl'].'/api/soap/?wsdl', array(
				'trace' => 1
			));
			
			$this->session = $this->client->login($config['username'], $config['apiKey']);
		}
	}
	
	public function call($method, $args = null) {
		return  $this->client->call($this->session, $method, $args);
	}
	
	public function getLastRequest() {
		return $this->client->__getLastRequest();
	}
	
	public function getLastResponse() {
		return $this->client->__getLastResponse();
	}
}