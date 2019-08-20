<?php
require 'vendor/autoload.php';
$session = new SpotifyWebAPI\Session(
    '3045f56e3a644e149e347dc13927d471',
    '2a5ebcf14ff74ca28545a0361f58506a',
    'http://spotify-api-php.io/callback.php'
);
$options = [
    'scope' => [
        'playlist-read-private',
        'user-read-private',
        'playlist-modify-public',
        'playlist-modify-private'
    ],
];

header('Location: ' . $session->getAuthorizeUrl($options));
die();
?>
