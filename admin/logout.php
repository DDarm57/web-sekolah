<?php
session_start();
unset($_SESSION['log']);
unset($_SESSION['id_admin']);
unset($_SESSION['username']);
unset($_SESSION['passwrod']);
unset($_SESSION['user_name']);
session_destroy();
sleep(1);
header('location: ../login.php');
