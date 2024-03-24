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
//TODO don't put the users' input directly
if(isset($_GET['account_name']))
{
    //establish mysql connection by the wll of Allah
    mysqli_connect();

    $account_name = htmlspecialchars($_GET['account_name']);
    $blog_id          = $_GET['blog_id']          ?? null;
    $blog_id_next     = null;
    $blog_id_previous = null;
    echo '<p>browsing user \'' . $account_name . '\'</p>';
    if(null !== $blog_id)
    {
        echo '<p>blog id: '          . $blog_id                            . '</p>';
        echo '<p>next blog_id: '     . $blog_id_next     ?? 'NONE' . '</p>';
        echo '<p>previous blog_id: ' . $blog_id_previous ?? 'NONE' . '</p>';
        if($_SESSION['user_name'] == $account_name)
        {
            echo '<div><a>edit</a></div>';
        }
    }
    else
    {
        echo '<p>incha2Allah will have a list of blogs here</p>';
        echo '<div class="blog_browse"><p>incha2Allah first blog</p></div>';
    }
}
else
{
    echo '<p>serach a user to start browsing incha2Allah<p>';
    echo '<form method="get" action="bismi_allah.php"><label for="account_name">search user</label><br><input type="text" name="account_name"></form>';
}
?>

</body>
</html>

