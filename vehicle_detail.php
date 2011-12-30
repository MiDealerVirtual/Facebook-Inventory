<?php 
	//including api_interface file
	require_once("api_interface.php");
	
	//Api object declaration
	$api = new api_call();
	
	// Fetch single vehicle by using interace
	$single_vehicle_json = file_get_contents( $api->getVehicle( $_GET['cid'], $_GET['vid'] ) );
	
	// Decode json object
	$single_vehicle = json_decode( $single_vehicle_json ); // Convert json string into php object
	
	// Getting images of selected vehicle
	$vehicle_images = $api->makeCall( $api->getVehicleImages( $_GET['vid'] ) );
	
	
	// checking if IOL_IMAGE is set to 1. To set the image pagth
	if($single_vehicle->IOL_IMAGE=='1')
	{
		$bigImgPath="http://midealervirtual.com/vpics/iol_imports/web/";
		$imgPath="http://www.midealervirtual.com/vpics/iol_imports/med/med_";
		$TinyImgPath="http://www.midealervirtual.com/vpics/iol_imports/tiny/tiny_";
	}
	else
	{
		$bigImgPath="http://midealervirtual.com/vpics/web/";
		$imgPath="http://www.midealervirtual.com/vpics/med/med_";
		$TinyImgPath="http://www.midealervirtual.com/vpics/tiny/tiny_";
	}
	
	$vImages="";
	foreach( $vehicle_images as $vImg )
	{ 
		$vImages.="'".$imgPath.$vImg->IMAGE_NAME."',";
		//print_r($vImg);
	}
	$vImages=substr($vImages,0,strlen($vImages)-1);
	
	//Getting Delaer name
	$dealer=$api->makeCall( $api->getDealer($_GET['cid']));
	
	
	//print_r($dealerName);
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $dealer->DISPLAY_NAME;?></title>
    <link type="text/css" rel="stylesheet" href="vehicles.css" />
    
	<script type="text/javascript" src="js/jquery.js"></script>
    <script src="js/cycle.js" type="text/javascript"></script>
    
	<script type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
    
	
    <script type="text/javascript">
//Setting image in main div
		function setImage(imgSrc,TSrc)
		{
			document.getElementById("main_pic").innerHTML="<ul><li><a href='"+imgSrc+"' title='<?php echo $single_vehicle->MAKE.' '.$single_vehicle->MODEL.' '.$single_vehicle->YEAR; ?>'><img src="+TSrc+" /></a></li></ul>";
			
			//REFRESHING GALLERY IMAGE
			RefreshGallery();

		}
		
		//UPDATING IMAGE LINK IN JQUERY LIGHTBOX PLUGIN
		function RefreshGallery()
		{
			$('#main_pic a').lightBox();
		}
		
		$(function() {
            $('#main_pic a').lightBox();
        });
		
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
    </script>
       
</head>
<body onLoad="MM_preloadImages(<?php echo $vImages;?>)" >

	<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '206188906125701', // App ID
      channelUrl : '//WWW.isoft-tech.COM/channel.php', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    // Additional initialization code here
  };

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     d.getElementsByTagName('head')[0].appendChild(js);
   }(document));
</script>


	<!-- start container -->
  <div id="container">
    	<!-- start main -->
		<div id="main">     
            <!-- start content -->
            <div class="content">
	            <div class="title_detail"><h1><?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?></h1></div>
            
            	<div class="box_detail_2">
		            <div class="thumb_med" id="main_pic"><ul><li>
			            <a href="<?php echo $bigImgPath.$single_vehicle->IMAGE;?>" title="<?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?>"><img src="<?php echo $imgPath.$single_vehicle->IMAGE;?>" title="<?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?>" alt="<?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?>" /></a></li></ul>
		            </div>
	            </div>
                
                <div class="box_detail_3">
                	<?php foreach( $vehicle_images as $vImg )
							{ 
								//print_r($vImg);
							?>
                            
                    <div class="thumb_tiny"><a href="#" onClick="setImage('<?php echo $bigImgPath.$vImg->IMAGE_NAME;?>','<?php echo $imgPath.$vImg->IMAGE_NAME;?>');" title="<?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?>">
                    <img src="<?php echo $TinyImgPath.$vImg->IMAGE_NAME;?>" alt="<?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?>" title="<?php echo $single_vehicle->MAKE." ".$single_vehicle->MODEL." ".$single_vehicle->YEAR; ?>" /></a></div>
                    
                    <?php }?>
                    
                    
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
                        <li><a name="fb_share" type="button" share_url="www.isoft-tech.com/midealervirtual/vehicle_detail.php?cid=<?php echo $_GET['cid'];?>&vid=<?php echo $_GET['vid'];?>">Share</a> 
						<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" 
                                type="text/javascript">
                        </script></li>
                    </ul>
                </div>
            <!-- FACEBOOK COMMENTS SECTION -->
                    <div id="fb-root"></div>
                    <script>if(window.FB){ window.FB = null ;}//eat this !</script>
					 <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=206188906125701";
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
        
            <div class="fb-comments" data-href="http://www.isoft-tech.com/midealervirtual/vehicle_detail.php?cid=<?php echo $_GET['cid'];?>&vid=<?php echo $_GET['vid'];?>" data-num-posts="2" data-width="500"></div>
            
            </div>
            <!-- end content -->
		</div>
        <!-- end main-->
    </div>
    <!-- end container -->
</body>
</html>

