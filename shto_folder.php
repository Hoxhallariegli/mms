<?php
//including the database connection file
include_once 'ini.php';
include_once("shto_function.php");
session_start();
    $user = new Login();
$crud = new Crud();
$validation = new Validation();

$query = "SELECT * FROM `consegna`";
$result1 = $crud->getData($query);
$crud = new Crud();
$validation = new Validation();

if (isset($_POST['submit'])){
        extract($_POST);
        shtoFolder($crud, $kodi,$operatori);
}

?>

   <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <title>Register</title>
     <?php include ('menu/menumjek.php'); ?>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
  </head>

  <body>
    <div id="container" class="container">
      <h1>Registration Here</h1>
      <form action="" method="post" name="reg">
        <table class="table">
          <tr>
            <th>Kodi:</th>
            <th>Operatori</th>
            <th>Butoni:</th>
          </tr>
          <tr>
            <td>
              <input type="text" name="kodi" required>
            </td>
            <td>
              <input type="text" name="operatori" required>
            </td>

            <td>
              <input class="btn" type="submit" name="submit" value="Shto punti" onclick="return(submitreg());">
            </td>
          </tr>
        </table>
      </form>
    </div>

    <script>
      function submitreg() {
        var form = document.reg;
        if (form.name.value == "") {
          alert("Enter name.");
          return false;
        } else if (form.uname.value == "") {
          alert("Enter username.");
          return false;
        } else if (form.upass.value == "") {
          alert("Enter password.");
          return false;
        } else if (form.uemail.value == "") {
          alert("Enter email.");
          return false;
        }
      }
    </script>
  </body>

  </html>