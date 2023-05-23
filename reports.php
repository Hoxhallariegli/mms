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

        if($level=='Supervisor' ||$level=='Admin'||$level=='Super_Admin'){
            ?>
            <a href='raporte_ditore.php' class="btn btn-danger" id="butoni_ri3"> Rapporti giornalieri</a>
            <a href='raporte_javore.php' class="btn btn-danger" id="butoni_ri2"> Rapporti settimanali</a>
            <a href='raport_i_detajuar.php' class="btn btn-danger" id="butoni_ri4"> Rapporti dettagliati</a>
            <a href='raporte_operatore.php' class="btn btn-danger" id="butoni_ri1"> rapporti per ogni operatore</a>
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
