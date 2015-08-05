<?php
	session_start();
	$id = $_GET['id'];
	include('csv_to_array.php');
	for($i=0; $i<count($albums);$i++){
		if($albums[$i]['id'] == $id){
			$url = $albums[$i]['url'];
			$title = $albums[$i]['title'];
		}
	}
	if(isset($_FILES['file_array'])){
		$name_array = $_FILES['file_array']['name'];
		$tmp_name_array = $_FILES['file_array']['tmp_name'];
		$type_array = $_FILES['file_array']['type'];
		$size_array = $_FILES['file_array']['size'];
		$error_array = $_FILES['file_array']['error'];
		for($i = 0; $i < count($tmp_name_array); $i++){
			if (move_uploaded_file($tmp_name_array[$i], "albums/" . $url . "/" . $name_array[$i])){
				echo $name_array[$i]." uploaded<br>";
			} else {
				echo "Failed to upload the file ".$name_array[$i]."<br>";
			}
		}
	}
	header('Location: galleryupload.php?id=' . $id);
?>