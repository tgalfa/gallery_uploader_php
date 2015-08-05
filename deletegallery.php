<?php
	include('csv_to_array.php');
	$id = $_GET['id'];
	$rows = file($filename);
	//search for the id and store the row in a variable ($string)  
	foreach($rows as $row){ 
		list($id_num, $title, $url)=explode(",",$row); 
		if($id_num == $id){
			$string = $row;
		}
	}
	//search which line contains the $string
	$lines = file($filename);
	$line_number = false;
	while (list($key, $line) = each($lines) and !$line_number) {
	   $line_number = (strpos($line, $string) !== FALSE) ? $key + 1 : $line_number;
	}
	//delete the line
	unset($lines[$line_number-1]);
	$lines = array_values($lines);
	file_put_contents($filename,implode($lines));
	//delete the folder 	
	$url = $albums[$id-1]['url'];
	$directoryname = "albums/" . $url;
	function removeDirectory($path) {
		$files = glob($path . '/*');
		foreach ($files as $file) {
			is_dir($file) ? removeDirectory($file) : unlink($file);
		}
		rmdir($path);
		return;
	}
	removeDirectory($directoryname);

	header("Location: editgallery.php");
?>