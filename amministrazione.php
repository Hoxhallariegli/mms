<?php
include_once('ini.php');
include('includes/header1.php'); 
include_once("shto_function.php");

if ($_SESSION["Ferid"] && ($_SESSION['Access']=='Supervisor' ||  $_SESSION['Access']=='Super_Admin')){
$crud = new Crud();
$validation = new Validation();
    $employee_id = $_SESSION['Ferid'];
    $level = $_SESSION['Access'];
$crud = new Crud();
    ?>


<style>
      h1{
        color: green;
        text-align: center;
      }
      div.one{
        margin-top: 40px;
        text-align: center;
      }
      button{
        margin-top: 10px;
      }
      </style>
<main class="container" id="dist_nga_header">
   <div class="one">

        <?php

            if($level=='Supervisor' ||$level=='Admin'|| $level=='Super_Admin'){
          ?>
                      <a href='index1.php' class="btn btn-danger" id="butoni_ri1"> Shto listat</a>
                      <a href='hartat.php' class="btn btn-danger" id="butoni_ri3"> Hartat</a>
                <a href='reports.php' class="btn btn-danger" id="butoni_ri2"> Raportet</a>
                <a href='provimet.php' class="btn btn-danger" id="butoni_ri4"> Provimi(R)</a>
             <?php }  
            }else{
                echo $level;
                ?> 
                    
               <p>Ju nuk keni akses ne kete faqe</p>
            </div>
            <?php 
            }
            ?>
    </body>
</html>
