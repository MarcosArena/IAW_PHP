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

<style type="text/css">
.form-style-1 {
    margin:10px auto;
    max-width: 400px;
    padding: 20px 12px 10px 20px;
    font: 13px "Lucida Sans Unicode", "Lucida Grande", sans-serif;
}
.form-style-1 li {
    padding: 0;
    display: block;
    list-style: none;
    margin: 10px 0 0 0;
}
.form-style-1 label{
    margin:0 0 3px 0;
    padding:0px;
    display:block;
    font-weight: bold;
}
.form-style-1 input[type=text], 
.form-style-1 input[type=date],
.form-style-1 input[type=datetime],
.form-style-1 input[type=number],
.form-style-1 input[type=search],
.form-style-1 input[type=time],
.form-style-1 input[type=url],
.form-style-1 input[type=email],
textarea, 
select{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    border:1px solid #BEBEBE;
    padding: 7px;
    margin:0px;
    -webkit-transition: all 0.30s ease-in-out;
    -moz-transition: all 0.30s ease-in-out;
    -ms-transition: all 0.30s ease-in-out;
    -o-transition: all 0.30s ease-in-out;
    outline: none;  
}
.form-style-1 input[type=text]:focus, 
.form-style-1 input[type=date]:focus,
.form-style-1 input[type=datetime]:focus,
.form-style-1 input[type=number]:focus,
.form-style-1 input[type=search]:focus,
.form-style-1 input[type=time]:focus,
.form-style-1 input[type=url]:focus,
.form-style-1 input[type=email]:focus,
.form-style-1 textarea:focus, 
.form-style-1 select:focus{
    -moz-box-shadow: 0 0 8px #88D5E9;
    -webkit-box-shadow: 0 0 8px #88D5E9;
    box-shadow: 0 0 8px #88D5E9;
    border: 1px solid #88D5E9;
}
.form-style-1 .field-divided{
    width: 49%;
}

.form-style-1 .field-long{
    width: 100%;
}
.form-style-1 .field-select{
    width: 100%;
}
.form-style-1 .field-textarea{
    height: 100px;
}
.form-style-1 input[type=submit], .form-style-1 input[type=button]{
    background: #4B99AD;
    padding: 8px 15px 8px 15px;
    border: none;
    color: #fff;
}
.form-style-1 input[type=submit]:hover, .form-style-1 input[type=button]:hover{
    background: #4691A4;
    box-shadow:none;
    -moz-box-shadow:none;
    -webkit-box-shadow:none;
}
.form-style-1 .required{
    color:red;
}
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
         $role=$_POST['role'];
     }            
        
    
             
       require ('../includes/functions.php');
       if($dni!="" AND $name!="" AND $surname!="" AND $telephone!="" AND $password!="" AND $code_dep!="" AND $role!="")	{
           insertUser($dni, $name, $surname, $email, $telephone, $password, $code_dep, $role);
           echo "<script>window.close();</script>";	
           header("location:./emp_list.php");
       }

      
       
    }
?>
</body>
</html>