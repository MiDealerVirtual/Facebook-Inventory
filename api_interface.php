<?
	// API call class
	class api_call
	{
		// Private Vars
		private $api = array();
		
		// Constructor
		public function __construct()
		{
			$this->api['URL'] = 'api.midealervirtual.com/s/dealer_vehicles/';
			$this->api['FORMAT'] = 'format/json';
			$this->api['AUTH'] = (object) array( 'uname' => 'dev', 'pword' => 'code123' );
		}
	
	# Public methods	
	
		// Get dealer vehicles
		public function getDealerVehicles( $cid /* client id */ )
		{
			// API url
			$url_to_use = $this->api['URL'].$this->api['FORMAT']."?cid=".$cid;
			return $this->authAPICall( $url_to_use );
		}
		
	# Private methods
		
		// Authorize API call
		private function authAPICall( $call_url )
		{
			// Finish `api_url`
			return 'http://' . $this->api['AUTH']->uname . ':' . $this->api['AUTH']->pword . '@' . $call_url;	
		}
	}
	
?>