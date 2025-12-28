<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form method="post">
    Username: <input type="text" name="username"><br>
    Password: <input type="text" name="password"><br>
    <button name="login">Login</button>
</form>
</body>
</html>

<?php 
$conn=mysqli_connect("localhost","root","","crud_db");

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if($data=mysqli_num_rows($result)) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 1;
        echo "Login Successful! Welcome, $username";
           $_SESSION['role'] = 2;
        echo "Login Successful! Welcome, $username";
        header("location:user.php");
    } else {
        echo "Invalid username or password!";
    }
}
?>