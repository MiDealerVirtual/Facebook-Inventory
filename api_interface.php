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
	
# Example of how to use this class: (Comment out and include this file to your index.php when you are ready to use)

	// create api interface
	$api = new api_call();
	
	// Fetch vehicles by using interace
	$vehicles_json = file_get_contents( $api->getDealerVehicles( $_GET['cid'] /* ID of a Client of ours */ ) );
	// Remember the format is returned
	
	// Decode json objects
	$vehicles = json_decode( $vehicles_json ); // Convert json string into php object
	
	// Loop thru results
	foreach( $vehicles as $v )
	{
		// Display all fields of $v
		$fields = "";
		foreach( array_keys( $v ) as $f )
		{
			$fields .= $f.", ";
		}
		echo trim( $fields, ", " )."<br /><br />";
		
		// Example of usage
		# echo $v->MAKE." ".$v->MODEL." ".$v->YEAR." ".$v->VIN."<br /><br />";
		
		// To see all fields of $v
		# print_r( $v );
	}
	
# End Example
?>