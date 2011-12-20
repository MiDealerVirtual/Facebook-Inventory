<?
	// API call class
	class api_call
	{
		// Private Vars
		private $api = array();
		
		// Constructor
		public function __construct()
		{
			$this->api['URL'] = 'api.midealervirtual.com/s/';
			$this->api['FORMAT'] = 'format/json';
			$this->api['AUTH'] = (object) array( 'uname' => 'dev', 'pword' => 'code123' );
		}
	
	# Public methods	
	
		// Get dealer vehicles
		public function getDealerVehicles( $cid /* client id */ )
		{
			// This call's API segment
			$api_segment = "dealer_vehicles/";
			
			// API url
			$url_to_use = $this->api['URL'].$api_segment.$this->api['FORMAT']."?cid=".$cid;
			return $this->authAPICall( $url_to_use );
		}
		
		// Get dealer's vehicle's information
		public function getVehicle( $cid /* client id */, $vid /* vehicle id */ )
		{
			// This call's API segment
			$api_segment = "vehicle/";
			
			// API url
			$url_to_use = $this->api['URL'].$api_segment.$this->api['FORMAT']."?cid=".$cid."&vid=".$vid;
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
	
	// create api interface
	$api = new api_call();
	
/* # Example of how to use this class: (Comment out and include this file to your index.php when you are ready to use)
	
	// Fetch vehicles by using interace
	$vehicles_json = file_get_contents( $api->getDealerVehicles( $_GET['cid'] ) );
	// Remember the format is returned
	
	// Decode json objects
	$vehicles = json_decode( $vehicles_json ); // Convert json string into php object
	
	// Fields available: VEH_ID, CLIENT_ID, CATEGORY, PRICE, PRICE_STRING, HIDE_PRICE, BASE_PRICE, NEGOTIABLE, TYPE, CONDITION, KEYWORDS, DESCRIPTION, FEATURES, MAKE, MODEL, TRIM, YEAR, MILEAGE, VIN, TRANSMISSION, COLOR, VIDEO_EMBED_CODE, PAUSED, SOLD, DELETED, VIEWS, TELEPHONE_VIEWS, IOL_EDIT_STATUS, IOL_IMAGE, EDIT_DATE, CREATED_DATE, IMAGE, TELEPHONE
	
	// Loop thru results
	foreach( $vehicles as $v )
	{
		// Example of usage
		echo $v->MAKE." ".$v->MODEL." ".$v->YEAR." ".$v->VIN."<br /><br />";
		
		// To see all fields of $v
		# print_r( $v );
	}
	
# End Example */

# Example #2: Fetch a single car

	// Fetch single vehicle by using interace
	$single_vehicle_json = file_get_contents( $api->getVehicle( $_GET['cid'], $_GET['vid'] ) );
	
	// Decode json object
	$single_vehicle = json_decode( $single_vehicle_json ); // Convert json string into php object
	
	// Print vehicle's data
	print_r( $single_vehicle );

# End Example
?>