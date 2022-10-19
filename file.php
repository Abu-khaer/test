<?php
 $conn = mysqli_connect('localhost', 'root', '', 'sirat');
 
 if (!$conn) {
    echo "something went wrong";
 }

if(isset($_POST['submit'])){
    $file = $_FILES['img'] ['name'];
    $tmp = $_FILES['img'] ['tmp_name'];
    $file_type = $_FILES['img'] ['type'];
    $file_size = $_FILES['img'] ['size'];

    $upload = 'photo/'.$file;

    if($file_type == 'image/jpeg'){
        if($file_size < 2e6){
            if(file_exists($upload)){
                echo "file already uploaded ";
            }else{
                if(move_uploaded_file($tmp, $upload)){
                    $query = "INSERT INTO image(imagename) VALUES ('$file')";

                    if(mysqli_query($conn, $query)){

                    }else{
                        echo "Something went wrong";
                    }
                    echo "Your Photo uploaded";
                }
            }
        }
    }

}

 ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>file upload</title>
</head>
<body>
    <form action="" enctype="multipart/form-data" method="post">

    <label for="">Upload your Picture</label><br><br>
    <input type="file" name="img" ><br><br>
    <input type="submit" value="Upload file" name="submit">
    </form>
</body>
</html>

<?php
$query = "SELECT * FROM image";

$sql = mysqli_query($conn, $query);

while ($data = mysqli_fetch_assoc($sql)) {
    echo $data['imagename'];
    $image = $data['imagename'];
    echo "<img src='photo/$image'>";
    
}



?>