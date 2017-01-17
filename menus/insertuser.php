<html>
<head>
</head>
<body>
<form method="POST" action="insertuser.php">
<ul class="form-style-1">
    <li><label>Full Name <span class="required">*</span></label><input type="text" name="name" class="field-divided" placeholder="First" />&nbsp;<input type="text" name="surname" class="field-divided" placeholder="Last" /></li>
    <li>
        <label>DNI <span class="required">*</span></label>
        <input type="text" name="dni" class="field-long" />
    </li>
    <li>
        <label>Email <span class="required">*</span></label>
        <input type="email" name="email" class="field-long" />
    </li>
    <li>
        <label>Telephone <span class="required">*</span></label>
        <input type="number_format" name="telephone" class="field-long" />
    </li>
    <li>
        <label>Department</label>
        <select name="code_dep" class="field-select">
        <option value="2">Tecnology</option>
        <option value="3">Accounting</option>
        <option value="4">Sales</option>
        <option value="5">Purchases</option>
        </select>
    </li>
    <li>
    
        <label>Role</label>
        <select name="role" class="field-select">
        <option value="dep_boss">Department Boss</option>
        <option value="employee">Employee</option>        
        </select>
    </li>
    
    <li>
        <label>Password <span class="required">*</span></label>
        <input type="password" name="password" class="field-long" />
    </li>
    
    <li>  
    <li>
        <input type="submit" value="Submit" />
    </li>
</ul>
</form>
<style>
<?php include '../css/styles.css'; ?>
</style>

<?php
 if($_SERVER['REQUEST_METHOD'] == 'POST'){

     if(isset($_POST['dni'])){
         $dni=$_POST['dni'];
     }
     if(isset($_POST['name'])){
         $name=$_POST['name'];
     }
      if(isset($_POST['surname'])){
         $surname=$_POST['surname'];
     }
     if(isset($_POST['email'])){
         $email=$_POST['email'];
     }
      if(isset($_POST['telephone'])){
         $telephone=$_POST['telephone'];
     }
     if(isset($_POST['password'])){
         $password=$_POST['password'];
     }
    if(isset($_POST['code_dep'])){
         $code_dep=$_POST['code_dep'];
     }
     if(isset($_POST['role'])){
         $insertrole=$_POST['role'];
     }            
        
    
             
       require ('../includes/functions.php');
       if($dni!="" AND $name!="" AND $surname!="" AND $telephone!="" AND $password!="" AND $code_dep!="" AND $role!="")	{
           insertUser($dni, $name, $surname, $email, $telephone, $password, $code_dep, $insertrole);
           
           //header("location:./emp_list.php");
       }

      
       
    }
?>
</body>
</html>