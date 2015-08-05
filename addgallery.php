<!DOCTYPE html>
<html>
	<head>
		<title>Gallery</title>
	</head>
	<body>
		<div style="display: table; margin:auto; text-align: center;">
			<h2>Add new album</h2>
			<form  action="create_folder.php" method="post">
				<input name="foldername" id="foldername" value="Write the title here..."  
				onblur="if (this.value == '') {this.value = 'Write the title here...';}"
				onfocus="if (this.value == 'Write the title here...') {this.value = '';}">
				<input type="submit" value="Add" />
			</form>
		</div>
	</body>
</html>