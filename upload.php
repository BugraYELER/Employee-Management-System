<?php

require_once("Require.php");
$SearchQueryParameter = $_GET["id"];

if(isset($_POST['submittx'])){

    $files = $_FILES['fileToUpload'];
    
    $fileName = $files['name'];
    $fileSize = $files['size'];
    $fileTmpLoc = $files['tmp_name'];
    $fileError = $files['error'];

    $f = explode('.',$fileName);
    $fileExt = strtolower($f[1]);

    $allowedExt = array('jpeg','jpg','png');

    if(in_array($fileExt,$allowedExt)){
        if($fileSize < 2000000){
            $dest = 'uploads/'.$SearchQueryParameter.".png";
            move_uploaded_file($fileTmpLoc,$dest);
            echo "$ID";
            go("Update_emp.php?id=$SearchQueryParameter");

        }
        else{
            echo "File size exceeded";
        }

    }
    else{
        echo "File type not supported";
    }


}

?>