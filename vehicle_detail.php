<?php 
	//including api_interface file
	require_once("api_interface.php");
	
	//Api object declaration
	$api = new api_call();
	
	// Fetch single vehicle by using interace
	$single_vehicle_json = file_get_contents( $api->getVehicle( $_GET['cid'], $_GET['vid'] ) );
	
	// Decode json object
	$single_vehicle = json_decode( $single_vehicle_json ); // Convert json string into php object
	
	// checking if IOL_IMAGE is set to 1. To set the image pagth
	if($single_vehicle->IOL_IMAGE=='1')
	{
		$imgPath="http://www.midealervirtual.com/vpics/iol_imports/med/med_";
		$TinyImgPath="http://www.midealervirtual.com/vpics/iol_imports/tiny/tiny_";
	}
	else
	{
		$imgPath="http://www.midealervirtual.com/vpics/med/med_";
		$TinyImgPath="http://www.midealervirtual.com/vpics/tiny/tiny_";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Insert Dealer Name Here</title>
    <link type="text/css" rel="stylesheet" href="vehicles.css" />
    
    <script type="text/javascript">
		//Setting image in main div
		function setImage(imgSrc)
		{
			
			document.getElementById("main_pic").innerHTML="<a href='<?php echo $imgPath.$single_vehicle->IMAGE;?>' title='<?php echo $single_vehicle->MAKE.' '.$single_vehicle->MODEL.' '.$single_vehicle->YEAR; ?>'><img src="+imgSrc+" /></a>";
		}
	</script>
</head>
<body>
	<!-- start container -->
    <div id="container">
    	<!-- start main -->
		<div id="main">     
            <!-- start content -->
            <div class="content">
	            <div class="title_detail"><h1><?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?></h1></div>
            
            	<div class="box_detail_2">
		            <div class="thumb_med" id="main_pic">
			            <a href="<?php echo $imgPath.$single_vehicle->IMAGE;?>" title="<?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?>"><img src="<?php echo $imgPath.$single_vehicle->IMAGE;?>" title="<?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?>" alt="<?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?>" /></a>
		            </div>
	            </div>
                
                <div class="box_detail_3">
                    <div class="thumb_tiny"><a href="#" onClick="setImage('<?php echo $imgPath.$single_vehicle->IMAGE;?>');" title="<?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?>">
                    <img src="<?php echo $TinyImgPath.$single_vehicle->IMAGE;?>" alt="<?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?>" title="<?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?>" /></a></div>
                    
                    <div class="thumb_tiny"><a href="#" onClick="setImage('<?php echo $imgPath.$single_vehicle->IMAGE;?>');" title="<?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?>" >
                    <img src="<?php echo $TinyImgPath.$single_vehicle->IMAGE;?>" alt="<?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?>" title="<?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?>" /></a></div>
                    
                    <div class="thumb_tiny"><a href="#" onClick="setImage('<?php echo $imgPath.$single_vehicle->IMAGE;?>');" title="<?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?>" >
                    <img src="<?php echo $TinyImgPath.$single_vehicle->IMAGE;?>" alt="<?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?>" title="<?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?>" /></a></div>
                    
                    <div class="thumb_tiny"><a href="#" onClick="setImage('<?php echo $imgPath.$single_vehicle->IMAGE;?>');" title="<?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?>" >
                    <img src="<?php echo $TinyImgPath.$single_vehicle->IMAGE;?>" alt="<?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?>" title="<?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?>" /></a></div>
                    <div class="clear"></div>
                    
                </div>
                
                <div class="clear"></div>
            
            	<div class="box_detail_1">
                    <ul>
                        <li class="price"><strong>Precio:</strong> <span><?php echo $single_vehicle->PRICE;?></span></li>
                        <li><strong>Tel&eacute;fono:</strong> <a><?php echo $single_vehicle->TELEPHONE;?></a></li>
                        <li><strong>A&ntilde;o:</strong> <?php echo $single_vehicle->YEAR;?></li>
                        <li><strong>Color:</strong> <?php echo $single_vehicle->COLOR;?></li>
                        <li><strong>Condici&oacute;n:</strong> <?php echo $single_vehicle->CONDITION;?></li>
                        <li><strong>Transmisi&oacute;n:</strong> <?php echo $single_vehicle->TRANSMISSION;?></li>
                        <li><strong>VIN:</strong> <?php echo $single_vehicle->VIN;?></li>
                    </ul>
                </div>
            
            </div>
            <!-- end content -->
		</div>
        <!-- end main-->
    </div>
    <!-- end container -->
</body>
</html>

