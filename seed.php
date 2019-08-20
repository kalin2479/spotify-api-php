<?php
session_start();

require 'vendor/autoload.php';

$accessToken = $_SESSION['accessToken'];
$refreshToken = $_SESSION['refreshToken'];


$api = new SpotifyWebAPI\SpotifyWebAPI();

// Fetch the saved access token from somewhere. A database for example.
$api->setAccessToken($accessToken);


$seedGenres = $api->getGenreSeeds();

// var_dump($seedGenres);


// $items = $api->getNewReleases([
//     'country' => 'se',
// ]);

// var_dump($items);


$recommendations = $api->getRecommendations([
  'seed_genres' => ['instrumental,classical, slow'],
  // 'seed_genres' => ['reggaeton'],
  'limit' => 10,
  // 'min_danceability' => 0.6,
  // 'max_danceability' => 0.8,
  // 'min_energy' => 0.8,
  // 'mxn_energy' => 1,
  'min_duration_ms' => ['1600000']
]);

// var_dump($recommendations->tracks);
// var_dump($recommendations->tracks);
$data = '[';
$cont = count($recommendations->tracks) - 1;
$track = $recommendations->tracks;
for ($i=0; $i<= $cont; $i++){
  $idtrack    = $track[$i]->id;
  $timetrack  = $track[$i]->duration_ms;
  // echo "idtrack". " >> ". $idtrack;
  // echo "timetrack". " >> " .($timetrack/60000);
  // echo "<br>";
  if ($i==$cont){
    $data.= '"'.$idtrack.'"';
  }else{
    $data.= '"'.$idtrack.'",';
  }
}
$data.= "]";
// foreach ($recommendations->tracks as $track) {
//   // echo "<img src='".$artist->images[0]->url."' width='50px'/>", ' ';
//   echo $track->id. ' >> ';
//   echo $track->duration_ms. ' <br> ';
//   $data.= '"'.$track->id.'",';
//   // $data = '["'.$track->id.'", "'.$track->id.'"]';
// }
$obj = json_decode($data);
// var_dump($obj);
//
$myplayList = $api->createPlaylist([
    'name' => 'Kalin playlist 123'
]);

$myplayListID = (string)$myplayList->id;
$api->addPlaylistTracks($myplayListID, $obj);

?>
<!-- <iframe src="https://open.spotify.com/embed/playlist/7bJRIEmbT4M9xl9ZLkPg7P" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe> -->
<iframe src="https://open.spotify.com/embed/playlist/<?php echo $myplayListID;?>" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
<!-- <iframe src="https://open.spotify.com/embed/playlist/0FJJLWKT9kIzkrhc6Rwj6Y" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe> -->
<!-- <iframe src="https://open.spotify.com/embed/track/3EWvHg4cmrthPjpw3dyOLP" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe> -->
