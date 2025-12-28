<?php
include("db_conn.php");

$success = "";
$error   = "";

if (isset($_POST['save'])) {

    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $deppt_name = $_POST['deppt_name'];
    $age        = $_POST['age'];

    if ($_FILES['image']['name']) {

        $fileName  = $_FILES['image']['name'];
        $fileTmp   = $_FILES['image']['tmp_name'];
        $fileSize  = $_FILES['image']['size'];
        $fileError = $_FILES['image']['error'];

        $uploadDir = "uploads/";

        // create uploads folder if not exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = array("jpg", "jpeg", "png", "gif");

        // REAL image check (FIXED)
        $check = getimagesize($fileTmp);

        if ($check !== false && in_array($fileExt, $allowed)) {

            if ($fileError === 0) {

                if ($fileSize <= 2000000) {

                    $imageName = uniqid("img_", true) . "." . $fileExt;

                    if (move_uploaded_file($fileTmp, $uploadDir . $imageName)) {

                        $q = "INSERT INTO student
                              (first_name, last_name, deppt_name, age, image)
                              VALUES
                              ('$first_name','$last_name','$deppt_name','$age','$imageName')";

                        if (mysqli_query($conn, $q)) {
                            $success = "Data inserted successfully";
                        } else {
                            $error = "Database insert failed";
                        }

                    } else {
                        $error = "Image upload failed";
                    }

                } else {
                    $error = "Image too large (max 2MB)";
                }

            } else {
                $error = "File upload error";
            }

        } else {
            $error = "Invalid image file";
        }

    } else {
        $error = "Please select an image";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Insert</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>




 <a href="index.php"><button class="btn btn-success mt-5 mb-3 ">back</button></a>

<div class="container mt-5">

    <div class="card">
        <h3 class="bg-success text-white p-3">Student Insert Form</h3>

        <div class="card-body">

            <?php if ($success) { ?>
                <div class="alert alert-success">
                    <?= $success ?><br>
                    <img src="uploads/<?= $imageName ?>" width="150">
                </div>
            <?php } ?>

            <?php if ($error) { ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php } ?>

            <form method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Department</label>
                    <input type="text" name="deppt_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Age</label>
                    <input type="number" name="age" class="form-control" required>
                </div>

                <button type="submit" name="save" class="btn btn-success">Save</button>

            </form>

        </div>
    </div>

</div>
</body>
</html>
