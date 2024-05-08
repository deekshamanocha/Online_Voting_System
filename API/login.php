<?php
// session_start();
// require ("connect.php");

// $mobile = $_POST['mobile'];
// $password = $_POST['password'];
// $role = $_POST['role'];

// if (!$connect) {
//     echo '
//                 <script>
//                     alert("Could not Login");
//                 </script>
//             ';
// }

// $check = mysqli_query($connect, "SELECT * FROM userdata WHERE mobile = '$mobile' AND binary password = '$password' AND role = '$role'");

// if (mysqli_num_rows($check) > 0) {
//     $usersdata = mysqli_fetch_array($check);
//     $groups = mysqli_query($connect, "SELECT * FROM userdata WHERE role=2 ");
//     $groupdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

//     $_SESSION['usersdata'] = $usersdata;
//     $_SESSION['groupdata'] = $groupdata;

//     if ($role == 1) {
//         echo '
//                 <script>
//                     window.location.replace("../Routes/dashboard.php");
//                 </script>
//             ';
//     } else if ($role == 2) {
//         echo '
//                 <script>
//                     window.location.replace("../Routes/dashboard.php");
//                 </script>
                
//             ';
//     }


// } else {
//     echo '
//         <script>
//             alert("User not found or Wrong details!");
//             window.location = "../Login.html";
//         </script>        
//         ';
// }



session_start();
require("connect.php");

$mobile = $_POST['mobile'];
$password = $_POST['password'];
$role = $_POST['role'];

if (!$connect) {
    echo '
                <script>
                    alert("Could not Login");
                </script>
            ';
}

// Retrieve the hashed password from the database based on the provided mobile number and role
$check = mysqli_query($connect, "SELECT * FROM userdata WHERE mobile = '$mobile' AND  role = '$role'");
if (mysqli_num_rows($check) > 0) {
    $userData = mysqli_fetch_assoc($check);
    $hashedPassword = $userData['hash_password']; 
    $verify = password_verify($password, $hashedPassword);
    echo "Entered Password: " . $password . "<br>";
    echo "Hashed Password from Database: " . $hashedPassword . "<br>";
    echo "Password Verify Result: " . var_export($verify, true) . "<br>";    
    $hashpass = password_hash($password, PASSWORD_BCRYPT);
    echo'hashpass: '.$hashpass ;
    // Verify the entered password against the hashed password
    if ($verify) {
        // Password is correct
        $groups = mysqli_query($connect, "SELECT * FROM userdata WHERE role=2 ");
        $groupdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

        $_SESSION['usersdata'] = $userData;
        $_SESSION['groupdata'] = $groupdata;

        // Redirect based on role
        if ($role == 1 || $role == 2) {
            echo '
                <script>
                    window.location.replace("../Routes/dashboard.php");
                </script>
            ';
            exit();
        }
    } else {
        // Incorrect password
        echo '
            <script>
                alert("Incorrect password!");
                // window.location = "../Login.html";
            </script>        
        ';
        exit();
    }
} else {
    // User not found
    echo '
        <script>
            alert("User not found or Wrong details!");
            window.location = "../Login.html";
        </script>        
    ';
    exit();
}


?>