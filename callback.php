<?php
session_start();

require 'vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
  '3045f56e3a644e149e347dc13927d471',
  '2a5ebcf14ff74ca28545a0361f58506a',
  'http://spotify-api-php.io/callback.php'
);

// Request a access token using the code from Spotify
$session->requestAccessToken($_GET['code']);

$accessToken = $session->getAccessToken();
$refreshToken = $session->getRefreshToken();

// Store the access and refresh tokens somewhere. In a database for example.

$_SESSION['accessToken']  = $accessToken;
$_SESSION['refreshToken'] = $refreshToken;

// Send the user along and fetch some data!
header('Location: app.php');
die();

?>
