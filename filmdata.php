<?php
$idfilm=$_GET['imdb'];

	$handle = curl_init();
	$url = "http://www.omdbapi.com/?apikey=7f5af071&i=$idfilm";

// Set the url
	curl_setopt($handle, CURLOPT_URL, $url);

// Set the result output to be a string
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	$output = curl_exec($handle);
	curl_close($handle);

    $obj = json_decode($output, true);

?>
