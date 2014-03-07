<?php
	// Include utility files
	require_once 'include/config.php';	
		
	// Load the database handler
	require_once BUSINESS_DIR . 'database_handler.php'; 

	// Load Business Tier
	require_once BUSINESS_DIR . 'collection.php';
	
	header("Content-type: application/json");
	$response = '{"artistsarray":[';	

	//Check there's an input in the URL
	if (isset($_GET['artist']))
	{
		$artistsarray = Collection::GetArtistAlbums($_GET['artist']);	//Use the input to get  an array of Albums
		
		//Run for each album in the array
		foreach($artistsarray as $artist)
		{	
			$albumdetails = Collection::GetAlbumDetails($artist['album_id']);	//Use the ID for this album to get the other details
			
			$album_id = $artist['album_id'];			//Album ID
			$album_title = $albumdetails['album_title'];		//Album Title
			$artist = $albumdetails['artist'];			//etc...
			$image_url = "./images/" . $albumdetails['image'];
			$release_date = $albumdetails['release_date'];
			$average_rating = $albumdetails['average_rating'];
			$num_ratings = $albumdetails['no_ratings'];
			$date_bought = $albumdetails['date_bought'];
			$category = $albumdetails['category'];
			
			/* Create the JSON Response */
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
