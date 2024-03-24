<?php
//in the name of Allah
session_set_cookie_params(500);
session_start();
$bismi_allah_arr = explode("/", htmlspecialchars($_SERVER['REQUEST_URI']));
?>

<!DOCTYPE html>
<!--in the name of Allah-->
<html>
    <meta charset="UTF-8">
    <title>in the name of Allah</title>
    <link rel="stylesheet" href="res/bismi_allah.css" type="text/css">
</html>
<body>
<?php
    echo "<p>la ilaha illa Allah Mohammed rassoul Allah</p>";
echo '<pre>';
print_r($bismi_allah_arr);
echo '</pre>';
?>
</body>
</html>
