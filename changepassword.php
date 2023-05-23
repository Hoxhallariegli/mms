<?php
//including the database connection file
include_once('ini.php');

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

$crud = new Crud();
 $changepassword = new Login();


if (isset($_POST['submit'])){
        echo extract($_POST);
        $changepassword = $user->changePassword($employee_id, $password1, $password2, $password3);
        if ($changepassword) {
            // Registration Success
            if($level=='admin'){
            	echo "<div style='text-align:center'>Passwordi u ndryshua me sukses  <a href='admin.php'>Click here</a> to login</div>";
            }else{
            	echo "<div style='text-align:center'>Passwordi u ndryshua me sukses  <a href='index.php'>Click here</a> to login</div>";
            }
        } else {
            // Registration Failed
            echo "<div style='text-align:center'>Ndryshimi i passwordit deshtoi.</div>";
        }

}
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <title>OOP Login Module</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css"  href="css/styles.css"/>
  </head>

  <body>
    <div class="buttons">
 <a href="changepassword.php">  <button class="button button1"> Ndrysho Passwordin</button> 
 <a href="shtopunonjes.php" > <button class="button button2"> Shto Punonjes</button> </a>
   <a href="modifikopunonjes.php"> <button class="button button3"> Fshi/Edito Punonjes</button> </a>
</div>
    <div id="container" class="container">
      <h1 align="center">Ndrysho passwordin</h1>
      <form action="" method="post" name="login">
        <table >
          <tr>
            <th>Scrivi vechio password:</th>
            <td>
              <input type="password" name="password1" required>
            </td>
          </tr>
           <tr>
            <th>Scrivi nuovo password:</th>
            <td>
              <input type="password" name="password2" required>
            </td>
          </tr>
           <tr>
            <th>Riscrivi nuovo password:</th>
            <td>
              <input type="password" name="password3" required>
            </td>
          </tr>
          <tr>
          	<th>Submit</th>
          	<td>
          	 <input class="btn" type="submit" name="submit" value="Ndrysho" onclick="return(submitlogin());">

          	</td>
          </tr>
          

        </table>
      </form>
      <?php
      if($level=='admin'){
            	echo "<div style='text-align:center'><a href='admin.php'>Kliko ketu</a> per tu rikthyer</div>";
            }else{
            	echo "<div style='text-align:center'> <a href='userferie.php'>Kliko ketu</a> per tu rikthyer</div>";
            }

      ?>
    </div>
    <script>
      function submitlogin() {
        var form = document.login;
        if (form.emailusername.value == "") {
          alert("Enter email or username.");
          return false;
        } else if (form.password.value == "") {
          alert("Enter password.");
          return false;
        }
      }
    </script>


  </body>