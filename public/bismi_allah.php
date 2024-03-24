<?php
//in the name of Allah
session_set_cookie_params(500);
session_start();
$bismi_allah_request = explode("/", htmlspecialchars($_SERVER['REQUEST_URI']));
?>

<!DOCTYPE html>
<!--in the name of Allah-->
<html>
    <meta charset="UTF-8">
    <title>in the name of Allah</title>
    <link rel="stylesheet" href="/res/bismi_allah.css" type="text/css">
</html>
<body>
<?php
    echo "<p>la ilaha illa Allah Mohammed rassoul Allah</p>";
    print_r($bismi_allah_request);
if(0 === strcmp($bismi_allah_request[1], ''))
{
    echo '<p>requested /</p>';
}
elseif(0 === strcmp($bismi_allah_request[1], 'blogs'))
{
    echo '<p>requested \'blogs\'</p>';
}
elseif(0 === strcmp($bismi_allah_request[1], 'account'))
{
    echo '<p>requested \'account\'</p>';
}
?>
</body>
</html>
