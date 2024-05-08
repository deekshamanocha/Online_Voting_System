<?php
include ("connect.php");

$name = $_POST['name'];
$number = $_POST['number'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$confirmpassword = $_POST['confirmpassword'];
$address = $_POST['address'];
$image = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];
$role = $_POST['role'];

if ($password == $confirmpassword) {
    move_uploaded_file($tmp_name, "../uploads/$imag e");
    $mobiles = mysqli_query($connect, "select mobile from userdata where mobile =('$number')") or die(mysqli_error($con));
    if ($mobiles->num_rows > 0) {
        echo '
        <script> alert("Mobile number already exits");
        window.location = "../Routes/registeration.html";
        </script>
        ';
        exit();
    }
    $insert = mysqli_query($connect, "INSERT INTO userdata (name,mobile,password,gender,address,photo,role,status,votes) VALUE ('$name','$number','$password','$gender','$address','$image','$role',0,0)");
    if ($insert) {
        echo '
            <script>
                alert("Registration Successful");
                window.location = "../Login.html";
            </script>                
        ';
    } else {
        echo '
            <script>
                alert("Some error occured!");
                window.location = "../Routes/registeration.html";
            </script>                
        ';
    }
} else {
    echo '
            <script>
                alert("password and confirm passowrd does not match");
                window.location = "../Routes/registeration.html";
            </script>                
        ';
}



?>