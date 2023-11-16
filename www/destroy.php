<?php
session_start();

if (isset($_SESSION['cbelkaibech'])){

    $_SESSION['cbelkaibech'] = array();

    session_destroy();

    header("Location: index.php");

}




?>