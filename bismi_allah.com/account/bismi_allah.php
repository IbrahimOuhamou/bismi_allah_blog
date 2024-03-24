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
<?php
    if(!isset($_SESSION['user_name']))
    {
        echo '<p>want to login?</p><p><a href="login.php">login</a></p><p><a href="register.php">register</a></p>';
    }
    else
    {
        echo '<p> hello ' . $_SESSION['user_name'] . '</p>';
        echo '<p><a href="/browse/bismi_allah.php?account_name=' . $_SESSION['user_name'] . '">browse account?</a></p>';
        echo '<form method="post" action="bismi_allah.php"><input type="text"><button type="submit">submit</button></form>';
    }
?>
</body>
</html>

