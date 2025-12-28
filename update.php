<?php 
 include("db_conn.php");
  $id=$_GET['id'];
//   echo $id;
//   die();
$select="SELECT * FROM student where id='$id'";
$run=mysqli_query($conn,$select); 
$res=mysqli_fetch_array($run);
  
if(isset($_POST['update'])){

      $first_name=$_POST['first_name'];
      $last_name=$_POST['last_name'];
       $deppt_name=$_POST['deppt_name'];
      $age=$_POST['age'];

    
   $update = "UPDATE student set first_name='$first_name',last_name='$last_name',deppt_name='$deppt_name',age='$age' where id='$id'";
       $data=mysqli_query($conn,$update); 
//      echo "<pre>";
// print_r($update);  
// echo "<pre>";
// echo "hello";
// die();
      
       if($data){
            echo "update sucssfully ";
       
      }else{
        header("location:update.php");
      }

  // echo "<pre>";
  // print_r($query);
  // echo "</pre>";

  }

 ?>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">


<div class="container mt-5 mb-5 ">
    <div class="row">



        <a href="index.php"><button class="btn btn-primary mt-5 mb-3 ">back</button></a>
        <div class="col-md-12 ">
            <div class="card">
                <div class="card">
                    <h1 class="bg-danger text-white">Student Update Form</h1>
                </div>
                <form class="row g-3 needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">

                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">First name</label>
                        <input type="text" class="form-control" name="first_name" id="validationCustom01"
                            value="<?php echo $res['first_name']?>" required>
                        <div class="valid-feedback">

                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Last name</label>
                        <input type="text" class="form-control" name="last_name" id="validationCustom02"
                            value="<?php echo $res['last_name'] ?>" required>
                    </div>

                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">department name</label>
                        <input type="text" class="form-control" name="deppt_name" id="validationCustom02"
                            value="<?php echo $res['deppt_name'] ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Age</label>
                        <input type="number" class="form-control" name="age" id="validationCustom02"
                            value="<?php echo $res['age'] ?>" required>
                    </div>
            </div>



        </div>
        <input class="btn btn-danger" type="submit" name="update" value="update">


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