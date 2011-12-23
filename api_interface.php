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
	
		// Get dealer data
		// Return: dealer (std object)
		public function getDealer( $cid /* client id */ )
		{
			// This call's API segment
			$api_segment = "dealer/";
			
			// API url
			$url_to_use = $this->api['URL'].$api_segment.$this->api['FORMAT']."?cid=".$cid;
			return $this->authAPICall( $url_to_use );
		}
		
		// Get dealer vehicle count
		// Return: total vehicle count (int)
		public function getDealerCount( $cid /* client id */ )
		{
			// This call's API segment
			$api_segment = "dealer_vehicle_count/";
			
			// API url
			$url_to_use = $this->api['URL'].$api_segment.$this->api['FORMAT']."?cid=".$cid;
			return $this->authAPICall( $url_to_use );
		}
		
		// Get dealer vehicles
		// Return: dealer vehicles (std object)
		public function getDealerVehicles( $cid /* client id */, 
										   $offset = false /* offest of results */,
										   $limit = false /* limit results */,
										   $order_by = false /* order results by */,
										   $order_dir = false /* ordering direction */ )
		{
			// This call's API segment
			$api_segment = "dealer_vehicles/";
			
			// Prepare appended varibales
			$extra_vars = ( ( $order_by ) ? '&order_by='.$order_by : '' ).
						  ( ( $order_dir ) ? '&order_dir='.$order_dir : '' ).
						  ( ( $offset ) ? '&offset='.$offset : '' ).
						  ( ( $limit ) ? '&limit='.$limit : '' );
			
			// API url
			$url_to_use = $this->api['URL'].$api_segment.$this->api['FORMAT']."?cid=".$cid.$extra_vars;
			return $this->authAPICall( $url_to_use );
		}
		
		// Get dealer's vehicle's information
		// Return: vehicle (std object)
		public function getVehicle( $cid /* client id */, $vid /* vehicle id */ )
		{
			// This call's API segment
			$api_segment = "vehicle/";
			
			// API url
			$url_to_use = $this->api['URL'].$api_segment.$this->api['FORMAT']."?cid=".$cid."&vid=".$vid;
			return $this->authAPICall( $url_to_use );
		}
		
		// Get dealer's vehicle's images
		// Return: vehicle images (std object)
		public function getVehicleImages( $vid /* vehicle id */ )
		{
			// This call's API segment
			$api_segment = "vehicle_images/";
			
			// API url
			$url_to_use = $this->api['URL'].$api_segment.$this->api['FORMAT']."?vid=".$vid;
			return $this->authAPICall( $url_to_use );
		}
		
		// Make call and process result
		// Return: result(s) (std object)
		public function makeCall( $rest_call /* REST api url to execute */ )
		{
			// Fetch data
			$json = file_get_contents( $rest_call );
			
			// Return decoded json object
			return json_decode( $json ); // Convert json string into php object	
		}
		
		
	# Private methods
		
		// Authorize API call
		private function authAPICall( $call_url )
		{
			// Finish `api_url`
			return 'http://' . $this->api['AUTH']->uname . ':' . $this->api['AUTH']->pword . '@' . $call_url;	
		}
	}
	
/* # Example - paginate results:

	// create api interface
	$api = new api_call();
	
	// fetch paginated results
	$vehicles = $api->makeCall( $api->getDealerVehicles( 5 /* client id * /, 5 /* offset * /, 10 /* limit * / ) );
	
	// display results
	$i = 1;
	foreach( $vehicles as $v )
	{
		echo $i++ ."- ". $v->MAKE." ".$v->MODEL."<br />"; 	
	}
	
# End example */
?>