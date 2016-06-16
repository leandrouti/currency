<?php
	class Currency{
		private $baseUrl = 'https://openexchangerates.org/api/latest.json?';
		private $appID = 'app_id=';
		private $data = array();

		public function __construct($appID){
			$this->appID .= $appID;
			$this->data = json_decode($this->getLatestJSON(), true);
		}

		private function getLatestJSON(){
			return $json = file_get_contents($this->baseUrl . $this->appID);
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
	}
	include('credential.php');
	$cr = new Currency($appId);

	var_dump($cr->getQuote('JPY', true));
?>