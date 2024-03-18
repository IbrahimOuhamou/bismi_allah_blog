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
    echo '<p>connection to db established<br>incha2Allah will make sure user_name doesn\'t exist to create that user<br>if user_name exists incha2Allah will ask if user wants to redirect into login</p>';
    $input_username = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['user_name']));
    $input_password = $_POST['user_password'];
    $query = 'SELECT user_name, user_password_hash, user_password_salt FROM bismi_allah_users WHERE user_name = \'' . $input_username . '\';';
    $result = mysqli_query($db_connection, $query);
    if(0 < mysqli_num_rows($result))
    {
        echo '<p>username already exists<br><a href="login.php">want to login?</a></p>';
    }
    else
    {
        $salt = bin2hex(random_bytes(6));
        $query = 'INSERT INTO bismi_allah_users(user_name, user_password_hash, user_password_salt) VALUES ("' . $input_username . '", "' . hash('sha256', $input_password . $salt) . '" , "' . $salt . '");';
        if(mysqli_query($db_connection, $query))
        {
            echo '<p>alhamdo li Allah user created successfully<br><a href="login.php">you can now login</a></p>';
        }
        else
        {
            echo '<p><b>couldn\'t create user</b></p>';
        }
    }
}
else
{
    echo '
    <h3>regiter by the will of Allah</h3>
    <form action="register.php" method="post">
    <label>name:</label> <input type="text" name="user_name" id="user_name">
    <label>password:</label> <input type="password" name="user_password" id="user_password">
    <button type=submit>submit</button>
    </form>';
}
?>
</body>
</html>

