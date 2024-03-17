<?php
//in the name of Allah
session_set_cookie_params(500);
session_start();

$db_servername = "localhost";
$db_username = "bismi_allah_user";
$db_dbname = "bismi_allah_users";
$db_password = "bismi_allah";
$db_connection = null;
if(isset($_POST['user_name']) && isset($_POST['user_password']))
{
    $db_connection = mysqli_connect($db_servername, $db_username, $db_password, $db_dbname);
}
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
if(!$db_connection && isset($_POST['user_name']) && isset($_POST['user_password']))
{
    echo '<p>internal error connecting to database</p>';
}
elseif($db_connection)
{
    echo '<p>connection to db established<br>incha2Allah will make sure user_name doesn\'t exist to create that user<br>if user_name exists incha2Allah will ask if user wants to redirect into login</p>';
}
else
{
    echo '
    <h3>regiter by the will of Allah</h3>
    <form action="register.php" method="post">
    name: <input type="text" name="user_name" id="user_name">
    password: <input type="text" name="user_password" id="user_password">
    </form>'
}

?>
</body>
</html>

