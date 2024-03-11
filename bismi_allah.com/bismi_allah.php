<?php
//in the name of Allah
include_once('../../scripts/bismi_allah.php');
session_set_cookie_params(500);
session_start();
?>
<!DOCTYPE html>
<!--in the name of Allah-->
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="res/bismi_allah.css">
    <title>in the name of Allah</title>
</head>
<body>
    <p>in the name of Allah</p>
    <?php if(isset($_SESSION['user_name'])){echo '<p>' . $_SESSION['user_name'] . '</p>';} ?>
    <h2>account</h2>
    <ul>
        <li><a href="account">account</a></li>
        <li><a href="account/login.php">login</a></li>
        <li><a href="account/register.php">register</a></li>
    <ul>
    <h2><a href="browse">browse blogs</a></h2>
</body>
</html>

