<html>
<head>
  <?php  session_start(); ?>
</head>

<body>
<style>
<?php include '../css/styles.css'; ?>
</style>
<form method="POST" action="inserttask.php">
<ul class="form-style-1">
        <label>Name <span class="required">*</span></label>
        <input type="text" name="Name" class="field-long" />
    </li>
    <li>
        <label>Description <span class="required">*</span></label>
        <input type="text" name="Description" class="field-long" />
    </li>
    <li>
        <?php
            require ('../includes/mysqli_connect.php');
            $dep = $_SESSION['code_dep'];
            //Select for get the information
            $qs="SELECT DNI, Name FROM `employees` WHERE Code_Dep = $dep";
            $r = @mysqli_query ($dbc, $qs);
            echo '<label>Employee <span class="required">*</span></label>';
            echo '<select name="Name_Employee" class="field-select">';
            foreach ($r as $row) {
	            echo '<option value="' .$row["DNI"] .'">' . $row["Name"] . '</option>';
	        }
            echo '</select>';    
            mysqli_close($dbc); // Close the database connection.
        ?>
    </li>
        <li>
        <input type="submit" value="Submit" />
    </li>
</ul>
</form>

<style type="text/css">

</style>
<?php

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require ('../includes/mysqli_connect.php'); //Connection to bd

     if(isset($_POST['Name'])){
         $name=$_POST['Name'];
     }
      if(isset($_POST['Description'])){
         $description=$_POST['Description'];
     }
     if(isset($_POST['Name_Employee'])){
         $name_employee=$_POST['Name_Employee'];
     }

      $codeinsertdep = $_SESSION['code_dep'];

     //Query to obtain the id for the intert task
     $qid="SELECT ID FROM `tasks`";
     $s = @mysqli_query ($dbc, $qid);
     $numid = mysqli_num_rows($s);
     $id = $numid + 1;
    if($name!="" AND $description!="" AND $name_employee!=""){
           $it="
            INSERT INTO `tasks`(`ID`, `Name`, `Description`, `Time_Start`, `Time_Finish`, `State`, `Employee`, `Department`)
            VALUES ('$id', '$name', '$description', NOW(),NULL,'Open','$name_employee','$codeinsertdep')";
            if (mysqli_query($dbc, $it)) { 
             echo "New record created successfully";
           echo "<script>window.close();</script>";	
           header("location:./see_tasks.php");
            }else {
                echo "Error: ". mysqli_error($dbc);
                  }
           echo "<script>window.close();</script>";	
          //header("location:./see_tasks.php");
       }
    else{
        echo "Is not possible insert the task";
    }
      
    mysqli_close($dbc);
    }
?>
</body>
</html>