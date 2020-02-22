<?php
// Checks if input is valid
if(isset($_POST["submit"])) { // if a variable is declaredd when submit is pressed
    // variables
    $file = $_FILES['fileToUpload'];
    $fileName = $_FILES['fileToUpload']['name'];
    $fileTmpName = $_FILES['fileToUpload']['tmp_name'];
    $fileError = $_FILES['fileToUpload']['error'];
    $fileType = $_FILES['fileToUpload']['type'];// this gets the extension of the file already

    if($fileError > 0){ //if there is a error then display error sign
        echo 'Problem: '.$fileError;
        exit;
    } 
    
    if($fileType != 'image/jpeg' && $fileType != 'image/png'){ // this checks if the file extension is correct
        echo 'Problem: file is not a PNG image or a JPEG: ';
        exit;
    } 

     //$uploaded_file = 'uploads/'.$fileName;
	 $uploaded_file = $fileName;
     if(is_uploaded_file($fileTmpName)){
		if(!move_uploaded_file($fileTmpName,$uploaded_file)){
			echo '\t $FILES[$uploaded_file][$fileTmpName]'.$_FILES[$uploaded_file][$fileTmpName].'\t';
		//if(!move_uploaded_file($_FILES[$uploaded_file][$fileTmpName], "uploads/".$_FILES[$uploaded_file][$fileName]);
             echo 'Problem: Could not move file to destination directory';
			 echo '\t $fileName = '.$fileName.'\t';
             exit;
         }
    }
    else {
        echo 'Problem: Possible fle upload attack. Filename: '. $fileName;
        exit;
    }
    ?>

    <?php
	//Save meta data and name of image file to a text document
    $fp = fopen("gallery.txt", 'ab');
    
    if(!$fp){ // if fopen fails exit
        echo '<p><strong> Your order could not be processed at this time. 
        .Please try again later.</strong></p></body></html>';
        exit;
    }
	
	$getPhotoName = $_POST['photoName']; // input variables
	$getDateTaken = $_POST['dateTaken']; // use _POST because its safer
    $getPhotoGrapher = $_POST['photographer'];
    $getLocation = $_POST['location'];

    $outputString = $fileName."\t".$getPhotoName."\t".// string to append
    $getDateTaken."\t".$getPhotoGrapher."\t".$getLocation."\n";
	
	
	file_put_contents("gallery.txt", $outputString, FILE_APPEND); // append data here
	//Use rewind() to move the pointer to the start of the file
    rewind($fp);
    fclose($fp);
    ?>
	
<?php
    // Read file and add data to array and show pictures.
    $fp = fopen("gallery.txt", 'rb');

    if(!$fp){
        echo 'error line 67';
    }

    $bigarray = [];

    while(!feof($fp)){
        $lines = fgets($fp); // gets the whole line
        if($lines === false) break; // deletes empty line at the end
        $line = explode("\t",$lines); // explodes the lines into separate varaibles
        $tmparray = [$line[0],$line[1],$line[2],$line[3],$line[4]]; // pushing to an array
        array_push($bigarray,$tmparray);
    }
	
    fclose($fp); // close file

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
    </header>
	<!-- Create a form to perform the same thing as index.php and leave it blank-->
<form action = "gallery.php" method="post" enctype="multipart/form-data">
    <table> 
        <tr> 
            <td> 
            <div class="form-group">
            <h2>Sort By:
            <select id="sortby" class="form-control" name="sort">
                <option value="">Select...</option>
                <option value="name">Name</option>
                <option value="date">Date</option>
                <option value="photographer">Photographer</option>
                <option value="location">Location</option>
            </select>
            <button type="submit" name="ok">Ok</button>
            </h2>
        </div>
    </td>
	<form action = "gallery.php" method = "post" enctype = "multipart/form-data">
    <td> 
        <!--<input type="button" value="Add another Picture" onClick="javascript:history.go(-1)" />-->
		<!-- Go back to the uploads page if the user presses the add another picture button-->
		<!--<button type="submit" formaction="/index.html"> Add Another Picture</button>-->
		<button type="submit" formaction="/~cs431s28/assignment1/index.html"> Add Another Picture</button>
	</td>
	</form>
        </tr>
    </table>
</form>
    <div>
        <?php
            // output picture here
//If the user has pressed the ok button for sort....
if (isset($_POST["ok"])) {
//...have gallery.txt be read into $bigarray since the form has refreshed...
	 $fp = fopen("gallery.txt", 'rb');

    if(!$fp){
        echo 'error line 67';
    }
	
    $bigarray = [];

    while(!feof($fp)){
        $lines = fgets($fp); // gets the whole line
        if($lines === false) break; // deletes empty line at the end
        $line = explode("\t",$lines); // explodes the lines into separate varaibles
        $tmparray = [$line[0],$line[1],$line[2],$line[3],$line[4]]; // pushing to an array
        array_push($bigarray,$tmparray);
    }
	
    fclose($fp); // close file
// ...And sort the array according to which "sort" method the user selected in the dropdown
	switch($_POST["sort"]) {
		
		case 'name':
			array_multisort( array_column( $bigarray, 1),SORT_ASC, $bigarray);
			break;
		case 'date':
			array_multisort( array_column( $bigarray, 2), SORT_ASC, $bigarray);
			break;
		case 'photographer':
			array_multisort( array_column( $bigarray, 3),SORT_ASC, $bigarray);
			break;
		case 'location':
			array_multisort( array_column( $bigarray, 4),SORT_ASC, $bigarray);
			break;
		default:
			echo "broken on line 101 in gallery.php \n";
	}
} 
//Display the gallery by using a for loop and echo data-boxes to the screen
            $len = count($bigarray); // gets bigarray length
            for($row = 0; $row < $len; $row++){
                echo '<div class="list-content">';
                echo'<img class="picture-content" src="uploads/'.$bigarray[$row][0].'"/ alt="Something wrong"></img>'; // fileName
                echo'<div class="data-box">'.$bigarray[$row][1].'</div>'; // name
                echo'<div class="data-box">'.$bigarray[$row][2].'</div>'; // date
                echo'<div class="data-box">'.$bigarray[$row][3].'</div>'; // photographer
                echo'<div class="data-box">'.$bigarray[$row][4].'</div>'; // location
                echo'</div>';
            }
        ?>
    </div>
</main>
</body>
</html>
