<?php
session_start();
unset($_SESSION['user_log']);
unset($_SESSION['id_user']);
unset($_SESSION['username']);
unset($_SESSION['passwrod']);
unset($_SESSION['level']);
unset($_SESSION['created_at']);
session_destroy();
sleep(1);
header('location: ../login_ekstra.php');
