<?php
	include('csv_to_array.php');
	include('replace_characters.php');

	$foldername = $_POST["foldername"]; 
	$title = $foldername;
	//generate folder name from the title, replace unwanted characters
	$foldername = replace_characters($foldername);
	//create a folder if it doesn't exist
	if (!file_exists("albums/" . $foldername)) {
		mkdir("albums/" . $foldername, 0700);
	}
	else{
		header('Location: addgallery.php');
	}
	$url = $foldername;
	//count the number of rows in the file
	$file = file($filename);
	$num_rows = count($file);
	//add the new record (line) to the file
	if (!empty($title) && ($title !="Write the title here...")){
		$file = fopen($filename, "a");
		$line = array($num_rows,$title,$url);
		fputcsv($file, $line);
		fclose($file);
		header('Location: galleryupload.php?id=' . $num_rows);
	}
	else{
		header('Location: addgallery.php');
	}
?>