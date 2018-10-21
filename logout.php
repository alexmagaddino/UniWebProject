<?php
  session_start(); //chiama la variabile $_SESSION
  session_unset(); //svuota $_SESSION
  session_destroy(); //chiude la sessione
  header("location:index.php"); //torna alla homepage
?>