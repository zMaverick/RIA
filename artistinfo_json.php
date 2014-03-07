<?php
	// Include utility files
	require_once 'include/config.php';	
		
	// Load the database handler
	require_once BUSINESS_DIR . 'database_handler.php'; 

	// Load Business Tier
	require_once BUSINESS_DIR . 'collection.php';
	
	header("Content-type: application/json");
	$response = '{"artistsarray":[';	

	if (isset($_GET['artist']))
	{
		$artistsarray = Collection::GetArtistAlbums($_GET['artist']);
		
		foreach($artistsarray as $artist)
		{	
			$albumdetails = Collection::GetAlbumDetails($artist['album_id']);
			
			$album_id = $artist['album_id'];
			$album_title = $albumdetails['album_title'];
			$artist = $albumdetails['artist'];
			$image_url = "./images/" . $albumdetails['image'];
			$release_date = $albumdetails['release_date'];
			$average_rating = $albumdetails['average_rating'];
			$num_ratings = $albumdetails['no_ratings'];
			$date_bought = $albumdetails['date_bought'];
			$category = $albumdetails['category'];
			
			$response .= '{"album_id":"' . $album_id . '", ';
			$response .= '"album_title":"' . $album_title . '", ';
			$response .= '"artist":"' . $artist . '", ';
			$response .= '"image_url":"' . $image_url . '", ';
			$response .= '"release_date":"' . $release_date . '", ';
			$response .= '"average_rating":"' . $average_rating . '", ';
			$response .= '"num_ratings":"' . $num_ratings . '", ';
			$response .= '"date_bought":"' . $date_bought . '", ';
			$response .= '"category":"' . $category . '"},';
		}
	}
	
	$response .= ']}';
	echo $response;
	
	
?>		
