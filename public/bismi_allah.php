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
    
    <header>
        <a href="/">home</a>
        <a href="/account">account</a>
    </header>
    <p>la ilaha illa Allah Mohammed rassoul Allah</p>

<?php
if(0 === strcmp($bismi_allah_request[1], ''))
{
    echo '<h1>requested \'/\'</h1>';
}
elseif(0 === strcmp($bismi_allah_request[1], 'blogs'))
{
    echo '<h1>requested \'blogs\'</h1>';
    if(isset($bismi_allah_request[2]))
    {
        $blog_id = $bismi_allah_request[2];
        echo '<p><b>blog id is ' . $blog_id . ' </b></p>';
        if(is_numeric($blog_id))
        {
            echo '<p>alhamdo li Allah blg id is <b style="color:green;">VALID</b></p>';
        }
        else
        {
            echo '<p style="color: red;"><b>BLOG ID IS NOT VALID</b></p>';
        }
    }
}
elseif(0 === strcmp($bismi_allah_request[1], 'users'))
{
    echo '<h1>requested \'users\'</h1>';
}
elseif(0 === strcmp($bismi_allah_request[1], 'account'))
{
    echo '<h1>requested \'account\'</h1>';
}
else
{
    echo '<h1>PAGE NOT FOUND</h1>';
}
?>
</body>
</html>
