<?php 
	//including api_interface file
	require_once("api_interface.php");
	
	//$cid will be used as dealer id
	$cid=0;
	$cid=$_GET['cid'];
	
	//if no dealer id is set, dealer id 5 will be used as default
	if ($cid==0)
	{
		$cid=5;
	}
	
	//Api object declaration
	$api = new api_call();
	
	// Fetch vehicles by using interace
	$vehicles_json = file_get_contents( $api->getDealerVehicles( $cid /* ID of a Client of ours */ ) );
	// Remember the format is returned
	
	// Decode json objects
	$vehicles = json_decode( $vehicles_json ); // Convert json string into php object
	
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Insert Dealer Name Here</title>
    <link type="text/css" rel="stylesheet" href="iframe.css" />
</head>
<body>
	<!-- start container -->
    <div id="container">
    	<!-- start main -->
		<div id="main">
        	<!-- start squared / list -->
            <div class="squared clearfix" id="jq_inventory_view">
            <?
					// Fields available: VEH_ID, CLIENT_ID, CATEGORY, PRICE, PRICE_STRING, HIDE_PRICE, BASE_PRICE, NEGOTIABLE, TYPE, CONDITION, KEYWORDS, DESCRIPTION, FEATURES, MAKE, MODEL, TRIM, YEAR, MILEAGE, VIN, TRANSMISSION, COLOR, VIDEO_EMBED_CODE, PAUSED, SOLD, DELETED, VIEWS, TELEPHONE_VIEWS, IOL_EDIT_STATUS, IOL_IMAGE, EDIT_DATE, CREATED_DATE, IMAGE, TELEPHONE
	
			// Loop thru results
			foreach( $vehicles as $v )
			{
				// Example of usage
				//echo $v->MAKE." ".$v->MODEL." ".$v->YEAR." ".$v->VIN."<br /><br />";
				//echo $v->IMAGE;"<br>";
				
				// To see all fields of $v
				# print_r( $v );
				
			?>
                <!-- start result -->
                <div class="box_result clearfix">
                    <!-- start thumb -->
                    <div class="thumbs">
                    	<?php
							// checking if IOL_IMAGE is set to 1. To set the image pagth
                        	if($v->IOL_IMAGE=='1')
							{
								$imgPath="http://www.midealervirtual.com/vpics/iol_imports/thumb/thumb_";
							}
							else
							{
								$imgPath="http://www.midealervirtual.com/vpics/thumb/thumb_";
							}
						?>
                        <a href="inventario/kia-sorento-ex-2011-428" title="<?php echo $v->MAKE." ".$v->MODEL;?>" ><img src=<?php echo $imgPath.$v->IMAGE; ?> alt="<?php echo $v->MAKE." ".$v->MODEL;?>" title="<?php echo $v->MAKE." ".$v->MODEL;?>" /></a>
                    </div>
                    <!-- end thumb -->
                    
                    <!-- start info -->
                    <div class="info">
                        <div class="result_title">
                            <a href="inventario/kia-sorento-ex-2011-428" title="<?php echo $v->MAKE." ".$v->MODEL;?>"><?php echo $v->MAKE." ".$v->MODEL;?></a>
                        </div>
                        <ul>
                            <li><strong>A&ntilde;o:</strong> <?php echo $v->YEAR;?></li>
                            <li><strong>Color:</strong> <?php echo $v->COLOR;?></li>
                        </ul>
                        <ul>
                            <li><strong>Condici&oacute;n:</strong> <?php echo $v->CONDITION;?></li>
                            <li><strong>Transmisi&oacute;n: </strong> <?php echo $v->TRANSMISSION;?></li>
                        </ul>
                        <ul>
                            <li><strong>VIN:</strong><?php echo $v->VIN;?></li>
                            <li>&nbsp;</li>
                        </ul>
                    </div>
                    <!-- end info -->
                </div>
                <!-- end result -->
			<?
				}
			?>
            </div>
            <!-- end squared / list -->
		</div>
        <!-- end main-->
    </div>
    <!-- end container -->
</body>
</html>

