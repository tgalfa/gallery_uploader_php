#PHP gallery uploader  
I have previously created a similar uploader but with the help of MySQL.  
In this version the data is stored in a csv file.  

#FILES
csv_to_array.php - store the data from the csv file into a two dimensional associative array  
editgallery.php - show a list of albums (actions: add, edit, delete)  
addgallery.php - add a new album  
create_folder.php - create a folder for the newly added album and add a new record into the csv file  
replace_characters - remove unwanted characters from the folder name  
galleryupload - edit an album, rename the title, upload and delete pictures  
uploader - function for the image upload  
deletegallery - delete the relevant record from the csv file and its folder + pictures  
