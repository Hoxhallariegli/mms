<?php
//including the database connection file
include_once('classes/loginclass.php');
include_once('classes/crud.php');
include_once('classes/validation.php');
include_once('classes/dbconfig.php');

session_start();
if(!$_SESSION['uid']){
    echo 'nuk kemi akses';
}
    $user = new Login();
    $employee_id = $_SESSION['uid'];
    $level = $_SESSION['level'];

    if (!$user->get_session()){
       header("location:login.php");
    }

    if (isset($_GET['q'])){
        $user->user_logout();
        header("location:login.php");
    }
    if($level != 'admin'){
        echo "Nuk keni te drejte te aksesoni kete faqe";
        header("location:login.php");
    }
    $emri=$user->get_fullname($employee_id);

?>
 
<html>
<head>    
    <title>Aprovo Ferie</title>
 <!--   <link rel="stylesheet" type="text/css"  href="css/styles.css"/> -->
     <link rel="stylesheet" type="text/css"  href="css/styles.css"/>
<div class="buttons">
 <a href="changepassword.php"  <button class="button button1"> Ndrysho Passwordin</button> 
 <a href="shtopunonjes.php"> <button class="button button2"> Shto Punonjes</button> </a>
   <a href="modifikopunonjes.php"> <button class="button button3"> Fshi/Edito Punonjes</button> </a>
</div>
</head>
</br></br> 
<body>
</body>
</html>