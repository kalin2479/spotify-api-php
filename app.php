<?php
session_start();

require 'vendor/autoload.php';

$accessToken = $_SESSION['accessToken'];
$refreshToken = $_SESSION['refreshToken'];


$api = new SpotifyWebAPI\SpotifyWebAPI();

// Fetch the saved access token from somewhere. A database for example.
$api->setAccessToken($accessToken);

// Refrescamos el token una vez que expirado

// $session->refreshAccessToken($refreshToken);
//
// $accessToken = $session->getAccessToken();
//
// // Set our new access token on the API wrapper and continue to use the API as usual
// $api->setAccessToken($accessToken);

// fin de refrescar token


// It's now possible to request data about the currently authenticated user
// print_r(
//     $api->me()
// );

// Muscia de Spotify

// $track = $api->getTrack('11dFghVXANMlKmJXsNCbNl');
// echo '<b>' . $track->name . '</b> by <b>' . $track->artists[0]->name . '</b>';

$results = $api->search('estudiar', 'playlist',[
  'limit' => 3
]);
var_dump($results);
foreach ($results->playlists->items as $item) {
  echo "<img src='".$item->images[0]->url."' width='50px'/>", ' ';
  echo $item->name, ' >> ';
  echo $item->owner->display_name, ' <br> ';

}


// foreach ($results->tracks->items as $item) {
//   echo $item->album->artists[0]->name, ' ';
//   echo "<img src='".$item->album->images[0]->url."' width='50px'/>", ' ';
//   echo $item->album->name, '<br>';
// }
// foreach ($results->artists->items as $artist) {
//     echo $artist->name, '<br>';
// }

?>
<iframe src="https://open.spotify.com/embed/playlist/0J2FQs7OufBUzX4vDWfEs1" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
