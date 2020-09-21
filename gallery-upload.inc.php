<?php
/* This should be in a folder name "includes"*/
if(isset($_POST['submit'])){
    $Newfilename = $_POST['filename'];
    if(empty($Newfilename)){
        $Newfilename = "gallery";
    }else{
        $Newfilename = strtolower(str_replace(" ","-",$Newfilename));
        }
    $filetitle=$_POST['filetitle'];
    $filedesc=$_POST['filedesc'];

    $file = $_FILES['file'];

    $fileName =$file['name'];
    $fileType =$file['type'];
    $fileTmpName =$file['tmp_name'];
    $fileError =$file['error']; 
    $fileSize =$file['size'];
}

$ExtFileName = explode(".",$fileName);
$ExtName = strtolower(end($ExtFileName));

$ExtArray = array("jpeg","jpg","png");
if(in_array($ExtName,$ExtArray)){
    if($fileError === 0){
        if($fileSize < 2000000){
            $actualName = $Newfilename  . "." . uniqid("",true) . "." .$ExtName;
            $fileDestination = "../img/gallery/" . $actualName;

            include_once "dbh.inc.php";

            if (empty($filetitle) || empty($filedesc)){
                header("Location: ../cases.php?upload=empty");
                exit();
            } else {
                $sql = "SELECT * FROM  gallery;";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    echo "SQL statement failed!";
                }else{
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $rowCount = mysqli_num_rows($result);
                    $setImageOrder = $rowCount + 1;

                    $sql = "INSERT INTO gallery (titleGallery, descGallery, imgFullNameGallery, orderGallery) VALUES (?,?,?,?);";
                    if(!mysqli_stmt_prepare($stmt,$sql)){
                        echo "SQL statement failed!";
                    }else{
                        mysqli_stmt_bind_param($stmt,"ssss", $filetitle, $filedesc, $actualName,  $setImageOrder);
                        mysqli_stmt_execute($stmt);

                        move_uploaded_file($fileTmpName,$fileDestination);
                        header("Location: ../cases.php?upload=success");
                }
            }
        }
    } else{
            echo "File is too large!";
            exit();
        }
    }else{
        echo "Upload Error!";
        exit();
    }
}else{
    echo "File not supported!";
    exit();
}







