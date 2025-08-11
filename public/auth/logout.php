<?php
require_once '../../utils/Auth.php';
Auth::logout();
header('Location: /public/auth/login.php');
exit();
?>