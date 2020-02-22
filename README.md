# CPSC431Assignment1

## Team member names incl. CWID,
Mauricio Macias, CWID: 890741622
Maria Diaz, CWID: 888888914

## Short introduction and explanation of each team member's contributions
Mauricio added the style sheets and created the "look" of the project's index. html and gallery.php files. 
He also took the index.html prototype and created the final file, added the use of style sheets. Mauricio added error checking to the gallery.php and created the entire front end of gallery.php. He also created the loop that gets the metadata from gallery.txt and puts it in an array and displays the gallery.

Maria prototyped the design and php code for upload photo and user information page. She also prototyped and wrote the file system storage portion in which user information is read to and saved as a text file. She wrote this readme file. She also wrote the gallery.php sorting algorithm and connected it to the drop down menu.

Both worked on debugging and suggesting solutions.

## Complete contents of gallery.php file incl. comments

`code()`
<?php
if(isset($_POST["submit"])) {
    // variables
    $file = $_FILES['fileToUpload'];
    $fileName = $_FILES['fileToUpload']['name'];
    $fileTmpName = $_FILES['fileToUpload']['tmp_name'];
    $fileError = $_FILES['fileToUpload']['error'];
    // this gets the extension of the file already
    $fileType = $_FILES['fileToUpload']['type'];

    //if there is a error then display error sign
    if($fileError > 0){
        echo 'Problem: '.$fileError;
        exit;
    } 
    // this checks if the file extension is correct
    if($fileType != 'image/jpeg' && $fileType != 'image/png'){
        echo 'Problem: file is not a PNG image or a JPEG: ';
        exit;
    } 

     $uploaded_file = 'uploads/'.$fileName;

     if(is_uploaded_file($fileTmpName)){
         if(!move_uploaded_file($fileTmpName,$uploaded_file)){
             echo 'Problem: Could not move file to destination directory';
             exit;
         }
    }
    else {
        echo 'Problem: Possible fle upload attack. Filename: '. $fileName;
        exit;
    }
    // echo 'File uploaded successfully';
    // echo '<img src="uploads/'.$fileName.'"/>';
	
	//Save meta data and name of image file to a text document
	
	$fp = fopen("gallery.txt", 'rw+');
	
	$getPhotoName = $_REQUEST['photoName'];
	$getDateTaken = $_REQUEST['dateTaken'];
    $getPhotoGrapher = $_REQUEST['photographer'];
    $getLocation = $_REQUEST['location'];

	$outputString = $fileName."\t".$getPhotoName."\t".$getDateTaken."\t".$getPhotoGrapher."\t".$getLocation."\n";
	
	
	file_put_contents("gallery.txt", $outputString, FILE_APPEND);
	//Use rewind() to move the pointer to the start of the file
	rewind($fp);
	
	
	/*****************************************************************
	CONTINUE HERE:
	
	file_put_contents appends the latest entry to a file gallery.txt
	When you're testing, make sure to create this file in your directory
	
	(Each image and its meta data are stored as its own line in gallery.txt)
	
	Now, each image in gallery.txt needs to be displayed in its own container
	*********************************************************************
	*/
	
	//fclose($fp);
	
	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gallery</title>
    <link rel="stylesheet" 
    href="<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="stylesheets/styles.css">
</head>
<body>
    <header>
        <h1>View All Photos</h1>

        <!-- <div class="dropdown">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropright</button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
            </div>
        </div> -->
    </header>
    <div>
        <?php
        // variables
         $getPhotoName = $_REQUEST['photoName'];
         $getDateTaken = $_REQUEST['dateTaken'];
         $getPhotoGrapher = $_REQUEST['photographer'];
         $getLocation = $_REQUEST['location']; 
        // $files = scandir('folder/');
        // foreach($files as $file){
        echo '<div class="list-content">';
        echo'<img class="picture-content" src="uploads/'.$fileName.'"/ alt="mauricio"></img>';
        echo'<div class="data-box">'.$getPhotoName.'</div>';
        echo'<div class="data-box">'.$getDateTaken.'</div>';
        echo'<div class="data-box">'.$getPhotoGrapher.'</div>';
        echo'<div class="data-box">'.$getLocation.'</div>';
        echo'</div>';
        // }
		
		
        ?>
    </div>
</main>
</body>
</html>
