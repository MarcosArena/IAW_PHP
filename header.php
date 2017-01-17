<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>See tasks</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/logo-nav.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">

 

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./start.php">
                    <img src="http://placehold.it/150x50&text=Logo" alt="">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                
                <!--Show different header menu options depending of the role of the person that logged in-->
                <ul class="nav navbar-nav">
                    <li>
                        <?php
                        if(isset($_SESSION['role'])){
                            if($_SESSION['role']=='employee'){ 

                                echo'<a href="./see_tasks.php">See tasks</a>';    
                            }

                            else if($_SESSION['role']=='dep_boss'){

                                echo '<a href="./see_tasks.php">See tasks</a>';
                            }
                            else if($_SESSION['role']=='staff_manager') {
                                echo '';
                            }
                            else if($_SESSION['role']=='big_boss'){
                                echo '<a href="./see_tasks.php">See tasks</a>';
                            }
                        }
                        ?>
                    </li>
                    <li>
                        <?php
                        if(isset($_SESSION['role'])){
                            if($_SESSION['role']=='employee'){
                                echo '';
                            }
                            else if($_SESSION['role']=='dep_boss'){
                                echo '<a href="./emp_list.php">See employees</a>';
                            }
                            else if($_SESSION['role']=='staff_manager') {
                                echo '<a href="./emp_list.php">See employees</a>';
                            }
                            else if($_SESSION['role']=='big_boss'){
                                echo '<a href="./emp_list.php">See employees</a>';
                            }
                        }                    
                        ?>
                    </li>

                    <li>
                        <a href="../logout.php">Log out</a>
                    </li>    


                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
</html>