<?php
//in the name of Allah
session_set_cookie_params(500);
session_start();
?>
<!DOCTYPE html>
<!--in the name of Allah-->
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../res/bismi_allah.css">
    <title>in the name of Allah</title>
</head>
<body>
    <p>in the name of Allah</p>
    <?php if(isset($_SESSION['user_name'])){echo '<p> hello ' . $_SESSION['user_name'] . '</p>';}
          else{echo '<p>want to login?</p><p><a href="login.php">login</a></p><p><a href="register.php">register</a></p>';} ?>
</body>
</html>

