<?php 
	//including api_interface file
	require_once("api_interface.php");
	
	//including functions file
	require_once("functions.php");
	
	//$cid will be used as dealer id
	$cid=0;
	$cid=$_GET['cid'];
	
	//$page is the current page number, if no page is selected it will be 1.
	$page=$_GET['page'];
	if(!isset($_GET['page']))
	{
		$page=1;
	}
	//if no dealer id is set, dealer id 5 will be used as default
	if ($cid==0)
	{
		$cid=5;
	}
	
	//Api object declaration
	$api = new api_call();
	
	// Getting total number of vehicles
	$total_vehicles=$api->makeCall( $api->getDealerCount($cid));
	
	// Call to pagination function to set values (Total pages, Next Page, Previous page)
	$total_pages=paginationStart($total_vehicles,10);
	$NextPage=$next_page;
	$PreviousPage=$prev_page;
	
	// Call to api to load vehicles for selected page number
	
	$vehicles = $api->makeCall( $api->getDealerVehicles( $cid , $page*10 , 10 ));
	
	//$vehicles = $api->makeCall( $api->getDealerVehicles( 5 , 7 , 10 ) );

?>
<!DOCTYPE html>
<html>
<head>
	<title>Insert Dealer Name Here</title>
    <link type="text/css" rel="stylesheet" href="vehicles.css" />
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
                        <a href="vehicle_detail.php?cid=<?php echo $cid;?>&vid=<?php echo $v->VEH_ID;?>" title="<?php echo $v->MAKE." ".$v->MODEL;?>" ><img src=<?php echo $imgPath.$v->IMAGE; ?> alt="<?php echo $v->MAKE." ".$v->MODEL;?>" title="<?php echo $v->MAKE." ".$v->MODEL;?>" /></a>
                    </div>
                    <!-- end thumb -->
                    
                    <!-- start info -->
                    <div class="info">
                        <div class="result_title">
                            <a href="vehicle_detail.php?cid=<?php echo $cid;?>&vid=<?php echo $v->VEH_ID;?>" title="<?php echo $v->MAKE." ".$v->MODEL;?>"><?php echo $v->MAKE." ".$v->MODEL;?></a>
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
            
            <!-- pagination footer div -->
            <div class="squared clearfix" id="pagination_footer">
            	<?php paginationFooter("cid=".$cid,"vehicle_list.php",$total_pages,$NextPage,$PreviousPage);
				?>
            </div>
            <!-- end pagination footer div -->
            
		</div>
        
        <!-- end main-->
    </div>
    <!-- end container -->
</body>
</html>

