<?php

for ($x = 1; $x <= 6; $x++) {

     $imgs = array('uploads/1', 'uploads/2', 'uploads/3', 'uploads/4', 'uploads/5', 'uploads/6');

     foreach ($imgs as $y){
        if (file_exists($y)){
            $x++;
        }
        if (isset($_POST['delete'])) {
            unlink($y);
            header("Location: index.php?deletesuccess");
        }
    }
   
    if (isset($_POST['submit'])) {
        $file = $_FILES['file'];

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'pdf');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1000000){
                    if ($x <= 6){
                        $fileNameNew = $x;
                        $fileDestination = 'uploads/'.$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        header("Location: index.php?uploadsuccess");
                    }else{
                        echo "To Many Cooks";
                    }
                } else{
                    echo "file is too big";
                }
            } else {
                echo "there was an error uploading file";
            }
        } else {
            echo "cannot upload files of this type";
        }
    } 
}
