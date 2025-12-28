<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 2) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3>Welcome User: <?php echo $_SESSION['username']; ?></h3>
    <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
</div>
</body>
</html>
