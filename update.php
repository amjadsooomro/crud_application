<?php
include("db_conn.php");

$success = "";
$error   = "";

// ID get (GET or POST)
$id = $_POST['id'] ?? $_GET['id'];

// fetch record
$select = "SELECT * FROM student WHERE id='$id'";
$run = mysqli_query($conn, $select);
$res = mysqli_fetch_assoc($run);

$oldImage = $res['image'];

// PATH CONFIG
$uploadPath = __DIR__ . "/uploads/";  // server filesystem path
$uploadUrl  = "uploads/";             // browser URL path

if (!is_dir($uploadPath)) {
    mkdir($uploadPath, 0777, true);
}

if (isset($_POST['update'])) {

    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $deppt_name = $_POST['deppt_name'];
    $age        = $_POST['age'];

    $imageName = $oldImage; // default old image

    // IMAGE UPDATE LOGIC
    if (!empty($_FILES['image']['name'])) {

        $fileTmp   = $_FILES['image']['tmp_name'];
        $fileSize  = $_FILES['image']['size'];
        $fileError = $_FILES['image']['error'];
        $fileExt   = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed   = ["jpg","jpeg","png","gif"];

        if (getimagesize($fileTmp) && in_array($fileExt, $allowed)) {

            if ($fileError === 0 && $fileSize <= 2000000) {

                // delete old image if exists
                if ($oldImage && file_exists($uploadPath.$oldImage)) {
                    unlink($uploadPath.$oldImage);
                }

                // upload new image
                $imageName = uniqid("img_", true).".".$fileExt;
                if (!move_uploaded_file($fileTmp, $uploadPath.$imageName)) {
                    $error = "Failed to upload new image.";
                }

            } else {
                $error = "Image size too large or file upload error.";
            }

        } else {
            $error = "Invalid image file type.";
        }
    }

    // UPDATE QUERY
    if (!$error) {
        $update = "UPDATE student SET
            first_name='$first_name',
            last_name='$last_name',
            deppt_name='$deppt_name',
            age='$age',
            image='$imageName'
            WHERE id='$id'";

        if (mysqli_query($conn, $update)) {
            $success = "Student updated successfully";
            // refresh record for form prefill
            $res['first_name'] = $first_name;
            $res['last_name']  = $last_name;
            $res['deppt_name'] = $deppt_name;
            $res['age']        = $age;
            $res['image']      = $imageName;
        } else {
            $error = "Update failed: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">

    <a href="index.php" class="btn btn-primary mb-3">Back</a>

    <?php if ($success) { ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php } ?>

    <?php if ($error) { ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>

    <div class="card">
        <h3 class="bg-danger text-white p-3">Update Student</h3>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <div class="mb-3">
                    <label>Current Image</label><br>
                    <img src="<?php echo $uploadUrl . $res['image']; ?>" width="120">
                </div>

                <div class="mb-3">
                    <label>New Image (optional)</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="mb-3">
                    <label>First Name</label>
                    <input type="text" name="first_name" value="<?php echo $res['first_name']; ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Last Name</label>
                    <input type="text" name="last_name" value="<?php echo $res['last_name']; ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Department</label>
                    <input type="text" name="deppt_name" value="<?php echo $res['deppt_name']; ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Age</label>
                    <input type="number" name="age" value="<?php echo $res['age']; ?>" class="form-control" required>
                </div>

                <button type="submit" name="update" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
