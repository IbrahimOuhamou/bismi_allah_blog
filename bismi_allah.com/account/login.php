<?php
//in the name of Allah
session_set_cookie_params(500);
session_start();

$db_servername = "localhost";
$db_username = "bismi_allah_user";
$db_dbname = "bismi_allah_blog";
$db_password = "bismi_allah";
$db_connection = null;
if(isset($_POST['user_name']) && isset($_POST['user_password']))
{
    $db_connection = mysqli_connect($db_servername, $db_username, $db_password, $db_dbname);
    mysqli_set_charset($db_connection, 'utf8mb4');
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
    $input_username = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['user_name']));
    $input_password = $_POST['user_password'];
    $query = 'SELECT user_name, user_password_hash, user_password_salt FROM bismi_allah_users WHERE user_name = \'' . $input_username . '\';';
    $result = mysqli_query($db_connection, $query);
    if(0 < mysqli_num_rows($result))
    {
        if($row = mysqli_fetch_assoc($result))
        {
            if(hash('sha256', $input_password . $row['user_password_salt']) == $row['user_password_hash'])
            {
                $_SESSION['user_name'] = $input_username;
                echo "<p>welcome $input_username</p>";
            }
            else
            {
                echo '<p><b>incorrect password, try again</b></p>';
            }
        }
    }
    else
    {
        echo "<p><b>user '$input_username' was not found</b><br><a href=\"register.php\">want toregister?</a></p>";
    }
}
else
{
    echo '
    <h3>login by the will of Allah</h3>
    <form action="login.php" method="post">
    <label>name:</label> <input type="text" name="user_name" id="user_name">
    <label>password:</label> <input type="password" name="user_password" id="user_password">
    <button type=submit>submit</button>
    </form>';
}
?>
</body>
</html>

