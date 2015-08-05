<?php
	include('csv_to_array.php');
	include('replace_characters.php');
	$id = $_GET['id'];
	$message = "";

	//find the array with the right id
	for($i=0; $i<count($albums);$i++){
		if($albums[$i]['id'] == $id){
			$url = $albums[$i]['url'];
			$title = $albums[$i]['title'];
		}
	}
	
	//if the submit button pressed
	if(isset($_POST['submit'])){
		$new_title = $_POST['foldername'];
		if (!empty($new_title)){
			$foldername = $_POST["foldername"]; 
			$new_title = $foldername;
			//generate folder name from the title, replace unwanted characters
			$foldername = replace_characters($foldername);
			//rename the folder
			rename("albums/" . $url, "albums/". $foldername);
			//read the entire string from the file
			$str=file_get_contents($filename);
			//replace the relevant title and url
			$str=str_replace("$title" . '"', "$new_title" . '"',$str);
			$str=str_replace("$url" . "\n", "$foldername" . "\n",$str);
			//write the entire string
			file_put_contents($filename, $str);
			
			header('Location: editgallery.php');
		}
		else{
			$message =  "<div style ='color:#da1337; font-weight: bold; font-size: 20px;'>Missing title</div>";
		}
	}
?>
<html>
	<head>
		<style>
			.img_container{
				position: relative; 
				left: 0; 
				top: 0; 
				float: left;
			}

			input.deleteImage{
				position: absolute; 
				bottom: 20px; 
				right: 5px;
			}
		</style>
	</head>

	<body>
		<div style="display: table; margin:auto;">
			<?php echo $message ?>
			<div style="text-align: center;">
				<h3>Edit album</h3>
				<form  action=<?php echo $_SERVER['PHP_SELF'] . "?id=" . $id; ?>  method="post" id="editform1">
					<strong>Title:</strong> <br>
					<textarea rows="1" name="foldername" id="foldername"><?php echo $title; ?></textarea><br>
					<input type="hidden" name="id" value="<?php echo $id; ?>"><br/>
					<input type="submit" name="submit" value="Save!" id="submit"/>
				</form>
				
				<form enctype="multipart/form-data" action="uploader.php?id=<?php echo $id; ?>" method="POST">
					<input type="file" multiple="" name="file_array[]"  style="cursor: pointer;"/>
					<input type="submit" value="Upload all pictures" />
				</form>
			</div>
			<div style="margin-top: 50px;">
				<?php
					//store all the picture files from the url folder in an array
                    $files = glob('albums/'. $url  . '/*.{jpg,JPG,png,PNG}', GLOB_BRACE);  
                    $i=-1; 
                    foreach($files as $file) {
						$i+=1;
                        echo "
                            <div class='img_container'>
                               	<img src='" . $file . "' id='$i'  width='150px' height='150px' style='margin:2px;'/>
                                <form method='post'>
									<input class='deleteImage' name='delete" . $i . "' type='submit' value='Delete' onClick='return deleteImage()'>
								</form>    
                             </div>";
                        if(isset($_POST['delete' . $i])){
							unlink($files[$i]);
							echo '<meta http-equiv="refresh" content="0">';
							}
                    }
                ?>
            </div>
		</div>
		<script>
			function deleteImage(){
				return confirm("Do you really want to delet the picture?")
			}
		</script>
	</body>
</html>