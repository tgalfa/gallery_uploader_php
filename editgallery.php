<?php include('csv_to_array.php'); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Gallery</title>
	</head>

	<body>	
		<div style="display: table; margin:auto;">
				<div style=" text-align: center; margin-bottom: 20px;">
					<h2>Albums</h2>
					<a href="addgallery.php" id="submit">Add album</a>
				</div>
				<table class="table-posts">
					<?php foreach ($albums as $album):?>
					<tr>
						<td><strong><?php echo $album['title'] ?></strong></td>
						<td><?php echo "<a href='galleryupload.php?id=" . $album['id'] . "'>Edit </a>"; ?></td>
						<td><?php echo "<a href='deletegallery.php?id=" . $album['id'] . "' onClick='return delGalleryConfirm()'>Delete</a>"; ?></td>
					</tr>
					<?php endforeach;?>
				</table>
		</div>
		<script>
			function delGalleryConfirm (){
				return confirm("Do you really want to delet this album?");
			}
		</script>
	</body>
</html>