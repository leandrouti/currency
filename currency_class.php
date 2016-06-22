<?php
	/*
	*	To use this class, first you need to register as a developer on
	*	https://openexchangerates.org and get the API key.
	*	This class translates the JSON from Open Exchange Rates into
	*	PHP Array.
	*	The base currency is USD (United States Dollar)
	*/

	class Currency{
		private $baseUrl = 'https://openexchangerates.org/api/';
		private $appID = 'app_id=';
		private $data = array();

		public function __construct($appID){
			$this->appID .= $appID;
			$this->data = json_decode($this->getLatestJSON(), true);
		}

		private function getLatestJSON(){
			$url = $this->baseUrl . 'latest.json?' . $this->appID;
			return $json = file_get_contents($url);
		}

		public function getQuote($cCode, $json = false){
			$output = array();
			if(array_key_exists($cCode, $this->data['rates'])){
				$output['timestamp'] = $this->data['timestamp'];
				$output[$cCode] = $this->data['rates'][$cCode];
				return ($json) ? json_encode($output) : $output;
			}else{
				return false;
			}
		}

		public static function getSymbolList(){
			$url = "https://openexchangerates.org/api/currencies.json";
			$list = file_get_contents($url);
			return json_decode($list, true);
		}
	}
	include('credential.php');
	$cr = new Currency($appId);
	echo '<pre>';
	var_dump($cr->getQuote('BRL'));
?>
