<?php
include("connection.php");

if(isset($_POST['Create_customer'])) {
    $Email = $_POST['Email'];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $PhoneNumber = $_POST['PhoneNumber'];
    $Password = $_POST['Password'];
    $ReferralCode = $_POST['ReferralCode'];

    // Check if Email already exists in the database
    $query = "SELECT * FROM signup WHERE Email ='$Email'";
    $result = mysqli_query($connect, $query);
    $Email_count = mysqli_num_rows($result);

    // Check if phone number already exists in the database
    $query = "SELECT * FROM signup WHERE PhoneNumber ='$PhoneNumber'";
    $result = mysqli_query($connect, $query);
    $PhoneNumber_count = mysqli_num_rows($result);

    if($Email_count > 0 || $PhoneNumber_count > 0) {
        echo '<script>
              alert("Email or Phone Number already exists");
              window.location.href="index.php";
              </script>';
        exit(); // Stop further execution
    } else {
        // Hash the password before storing it in the database
        $hash = password_hash($Password, PASSWORD_DEFAULT);
        
        // Insert the new user into the database
        $query = "INSERT INTO signup (Email, FirstName, LastName, PhoneNumber, password, ReferralCode) 
                  VALUES ('$Email', '$FirstName', '$LastName', '$PhoneNumber', '$hash', '$ReferralCode')";
        $result = mysqli_query($connect, $query);

        if($result) {
            header("Location: welcome.php");
            exit(); // Stop further execution
        } else {
            echo "Error: " . mysqli_error($connect);
        }
    }
}
?>
