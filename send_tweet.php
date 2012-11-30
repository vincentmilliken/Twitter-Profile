<?php session_start(); require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

$oauth_token = $_SESSION['access_token']['oauth_token']; 
$oauth_token_secret = $_SESSION['access_token']['oauth_token_secret'];
 
$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $_SESSION["access_token"]["oauth_token"], $_SESSION["access_token"]["oauth_token_secret"]);
$content = $tweet->get('account/verify_credentials');

$message = $_POST['twitter'];
header('Location: http://labs.vincentmilliken.com/twitterprofile/index.php?success=yes');
 
$tweet->post('statuses/update', array('status' => "$message"));?>

