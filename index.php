<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

<body>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 ">


                <a href="insert.php"><button class="btn btn-success mt-5 mb-3 ">+Add Student</button></a>
                <h1 class="text-center text-white bg-danger">::CRUD Application::</h1>


                <table class="table table-sliver table-responsive table-hover ">

                    <thead class="table-dark ">
                        <tr>

                            <th>std id</th>
                            <th>image</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Department Name</th>
                            <th>Age</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th>Action</th>
                            <td></td>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
     include("db_conn.php");
            $query=" SELECT * FROM  student";
             $result= mysqli_query($conn,$query);
             // $result=mysqli_num_rows($data);
// echo "<pre>";
//     print_r($query);
//     echo "</pre>";
             if ($result->num_rows > 0) 
             {
               while ($res = mysqli_fetch_assoc($result)) 
              {
                ?>

                        <tr class="">


                            <td><?php echo $res['id']?></td>
                            <td>
    <img src="uploads/<?php echo $res['image']; ?>" width="100" alt="Student Image">
</td>
                            <td><?php echo $res['first_name']?></td>
                            <td><?php echo $res['last_name']?></td>
                            <td><?php echo $res['deppt_name']?></td>
                            <td><?php echo $res['age']?></td>
                            <td></td>
                            <td></td>
  



                            <td><a href="update.php?id=<?php echo $res['id']; ?>"><button class="btn  btn-success"
                                        name="update" style="">Update</button></a></td>

                            <td> <a href="delete.php?id=<?php echo $res['id']; ?>"><button class="btn btn-danger"
                                        name="delete">Delete</button></a></td>
                            <td></td>
                            <?php
                 
               }
             }else{
                  echo "no records";
             }
          ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    </div>
    </div>
</body>

</html>