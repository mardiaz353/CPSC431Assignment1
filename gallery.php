<!DOCTYPE html>
<html>
<head>
<title>View All Photos</title>
</head>
<body>
<table style="border: 0px; padding 3px">

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;,
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>
</head>
<body>

<h2>View All Photos</h2>
<!--<td>Sort By</td>-->
<div class="dropdown">
  <button class="dropbtn">Sort By</button>
 
  <div class="dropdown-content">
    <a href="#">Photo Name</a>
    <a href="#">Photographer</a>
	<a href="#">Date Taken</a>
    <a href="#">Location</a>
  </div>
</div>

<form action="index.html" method="POST" enctype="multipart/form-data">
<table style="border: 0px;">
<tr style="background: #cccccc;"> </tr>

<tr>
<td>Upload</td>
<button type="submit" name="submit">Upload</button>
</tr>

</body>
</html>

<!--_______________________________________________________________________________-->

<?php
//we used 'submit' as the name inside our button
if (isset($_POST['submit'])) {
	//Here we need to upload the file
	//we need to get the information of the file
	//The super global $_FILES gets all the info from the files
	//We get 'file' because that's what we named it in our html doc
	$file = $_FILES['file'];
	
	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];

	//We want to take apart the name of the file, so we explode it
	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));
	
	//Tell what files we want to allow inside the website
	$allowed = array('jpg', 'jpeg', 'png', 'pdf');
	
	//This will check if the file extension is once from $allowed
	if(in_array($fileActualExt, $allowed)) {
		//0 means there were no errors uploading the file
		if($fileError === 0) {
			if($fileSize < 2000000) {
				//We need to give the file a proper name
				$fileNameNew = uniqid('', true).".".$fileActualExt;
				//Now we need to tell it where to upload this file in root folder
				$fileDestination = 'uploads/'.$fileNameNew;
				//Create the function that moves it to the actual location
				move_uploaded_file($fileTmpName, $fileDestination);
				header("Location: index.php?uploadsuccess");
			} else {
				echo "Your file is too big!";
			}
		} else {
			echo "There was an error uploading your file!";
		}
	} else {
		echo "You cannont upload files of this type!";
	}
}

?>
</table>
</body>
</html>