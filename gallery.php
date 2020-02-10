
<?php
// if(isset($_POST["submit"])) {
//     $file = $_FILES['fileToUpload'];
//     $fileName = $_FILES['fileToUpload']['name'];
//     $fileTmpName = $_FILES['fileToUpload']['tmp_name'];
//     $fileError = $_FILES['fileToUpload']['error'];
//     // this gets the extension of the file already
//     $fileType = $_FILES['fileToUpload']['type'];

//     //if there is a error then display error sign
//     if($fileError > 0){
//         echo 'Problem: ' . $fileError;
//         exit;
//     } 
//     // this checks if the file extension is correct
//     if($fileType != 'image/jpeg' && $fileType != 'image/png'){
//         echo 'Problem: file is not a PNG image or a JPEG: ';
//         exit;
//     } 

//      $uploaded_file = 'Users/mauriciomacias/Desktop/php/uploads/'. $fileName;

//      if(is_uploaded_file($fileTmpName)){
//          if(!move_uploaded_file($fileTmpName,$uploaded_file)){
//              echo 'Problem: Could not move file to destination directory';
//              exit;
//          }
//     }
//     else {
//         echo 'Problem: Possible fle upload attack. Filename: '. $fileName;
//         exit;
//     }

//     echo 'File uploaded successfully';
//     echo '<img src="/uploads/'.$fileName.'"/>';
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gallery</title>
    <link rel="stylesheet" 
    href="<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="stylesheets/styles.css">
</head>
<body>
    <header>
        <h1>View All Photos</h1>

        <div class="dropdown">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropright</button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
            </div>
        </div>
    </header>
    <div>
        <?php
            // echo '<div class="list-content">';
            // echo'<img class="picture-content" src="pic.jpeg" alt="mauricio"></img>'
            // echo'<div class="data-box">Name</div>'
            // echo'<div class="data-box">Date</div>'
            // echo'<div class="data-box">Location</div>'
            // echo'<div class="data-box">Photographer</div>'
            // echo'</div>'
        ?>
        <!-- The real picture box of  -->
        
        <div class="list-content"> 
            <img class="picture-content" src="pic.jpeg" alt="mauricio"></img>
            <div class="data-box">Name</div>
            <div class="data-box">Date</div>
            <div class="data-box">Location</div>
            <div class="data-box">Photographer</div>
        </div>
        <div class="list-content"> 
            <img class="picture-content" src="pic.jpeg" alt="mauricio"></img>
            <div class="data-box">Name</div>
            <div class="data-box">Date</div>
            <div class="data-box">Location</div>
            <div class="data-box">Photographer</div>
        </div>
        <div class="list-content"> 
            <img class="picture-content" src="pic.jpeg" alt="mauricio"></img>
            <div class="data-box">Name</div>
            <div class="data-box">Date</div>
            <div class="data-box">Location</div>
            <div class="data-box">Photographer</div>
        </div>
        <div class="list-content"> 
            <img class="picture-content" src="pic.jpeg" alt="mauricio"></img>
            <div class="data-box">Name</div>
            <div class="data-box">Date</div>
            <div class="data-box">Location</div>
            <div class="data-box">Photographer</div>
        </div>


    </div>
</main>
</body>
</html>
