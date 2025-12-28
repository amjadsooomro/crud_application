<?php



include("db_conn.php");

$id=$_GET["id"];
$q="SELECT * from student where id = '$id' ";

// echo $q;
// die();
$sql= mysqli_query($conn,$q);

// echo $sql;
$res=mysqli_fetch_array($sql);



if(isset($_POST["update"])){

$id=$_POST["id"];
    $first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$deppt_name = $_POST["deppt_name"];


    // $query= "UPDATE student SET first_name='$first_name'      where id=$id";
    $query = "UPDATE student 
          SET first_name='$first_name',
              last_name='$last_name',
              deppt_name='$deppt_name'
          WHERE id=$id";

    $sql= mysqli_query($conn,$query);
    $res=mysqli_fetch_array($sql);
    if($res){
        echo "update";


}else{
   echo "not update";
}
}
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <title>::CRUD Application::</title>
</head>

<body>
    <div class="container  mt-5 mb-5 ">
        <div class="row">

            <a href="index.php"><button class="btn btn-primary mt-5 mb-3 ">back</button></a>
            <div class="col-md-12 ">
                <div class="card">

                    <div class="card">
                        <h1 class="bg-success  text-white">Student upate Form</h1>
                    </div>
                    <form class="row g-3 needs-validation" novalidate method="post" action=""
                        enctype="multipart/form-data">

                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label">First name</label>
                            <input type="text" class="form-control" name="first_name" value="<?php echo $res['first_name']; ?>" id="validationCustom01" required>
                            <div class="valid-feedback">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom02" class="form-label">Last name</label>
                            <input type="text" class="form-control" name="last_name" value="<?php echo $res['last_name']; ?>" id="validationCustom02" required>
                        </div>

                        <div class="col-md-4">
                            <label for="validationCustom02" class="form-label">department name</label>
                            <input type="text" class="form-control" name="deppt_name" value="<?php echo $res['deppt_name']; ?>" id="validationCustom02" required>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom02" class="form-label">Age</label>
                            <input type="number" class="form-control" name="age" value="<?php echo $res['age']; ?>" id="validationCustom02" required>
                        </div>
                </div>


                <input class="btn btn-success" type="submit" name="update" value="save">

            </div>



            </form>
        </div>
    </div>
    </div>
    </div>
    <script type="text/javascript">
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
    </script>

</body>

</html>
<?php 



 ?>