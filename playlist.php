<?php
session_start();

require 'vendor/autoload.php';

$accessToken = $_SESSION['accessToken'];
$refreshToken = $_SESSION['refreshToken'];


$api = new SpotifyWebAPI\SpotifyWebAPI();

// Fetch the saved access token from somewhere. A database for example.
$api->setAccessToken($accessToken);


$results = $api->search('estudiar', ['track', 'artist'],[
  'limit' => 10
]);
var_dump($results);

foreach ($results->tracks->items as $item) {
  echo $item->album->artists[0]->name, ' ';
  echo "<img src='".$item->album->images[0]->url."' width='50px'/>", ' ';
  echo $item->album->name, '<br>';
}
// foreach ($results->artists->items as $artist) {
//     echo $artist->name, '<br>';
// }

?>
<iframe src="https://open.spotify.com/embed/playlist/0RYUJmZIh0f70MRfQGQfTF" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
