<?php
/**
 * @file
 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.
 */

/* Load required lib files. */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: ./clearsessions.php');
}
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];

/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* If method is set change API call made. Test is called by default. */
$content = $connection->get('account/verify_credentials'); ?>
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<!--[if IE]><![endif]-->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo " " . $content->name . "'s "; ?> Twitter Profile</title>	<meta name="description" content="">
	<meta name="keywords" content="" />
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width; initial-scale=1.0">
	<!-- !CSS -->
	<link rel="stylesheet" href="css/style.css">
	
	
	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->    
    
  </head>
  <body id="preload">

    <?php if (isset($menu)) { ?>
        <?php echo $menu; ?>
    <?php } ?>

    <?php if (isset($status_text)) { ?>
      <?php echo '<h3>'.$status_text.'</h3>'; ?>
    <?php } ?>
    
    <a href='./clearsessions.php'>Logout</a>
    
    <!-- sucess message -->
    	<?php if(!empty($_GET['success'])){  if($_GET['success'] == 'yes'){ $Success = 'Your data has been updated';
		}
		
		}
		
		//Then place this where ever you want the message to appear.
		
		if(isset($Success)){
		
		echo "<div class=\"alert alert-success\">".$Success."</div>";
		
		}
		?>
    
    
    <div class="main">
	   <div class="top">
	   <?php  echo "<img src= " . $content->profile_image_url ." />"; ?>
	   <h1> <?php echo " " . $content->name . " "; ?></h1>
	   <h2><?php echo "@" . $content->screen_name . " "; ?></h2>
	 </div> 
	    
	    
	    
   
	 <div class="middle">
   
   <div class="followers"> <p><?php echo "" . $content->followers_count . "<br> followers "; ?></p> </div>
   <div class="following"><?php echo "" . $content->friends_count . "<br> following "; ?></div>  
   <div class="tweets"><?php echo "" . $content->statuses_count . "<br> tweets "; ?></div>	 
   
   </div>
   
    <div class="description">
	    <p><?php echo $content->description; ?></p>
    </div>
    
    <div class="bottom">
    <form name="form1" method="post" action="send_tweet.php">
        
			<input name="twitter" type="text" id="twitter" class="input-medium search-query span10" rows="5" placeholder="Compose new tweet...">
			
		<!-- <input type="submit" name="Submit" class="btn" value="Submit"> -->
		
	</form>	
	</div> <!-- tweet -->
	
    </div>
    
    
     	 <p><?php // echo "" . $content->location . " "; ?></p>
   <?php // echo "<img src= " . $content->profile_background_image_url ." >"; ?>
  

  </body>
</html>