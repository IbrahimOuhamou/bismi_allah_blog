<?php
//in the name of Allah
session_set_cookie_params(500);
session_start();
$bismi_allah_request = explode('/', htmlspecialchars($_SERVER['REQUEST_URI']));

$db_connection = mysqli_connect('localhost', 0 === strcmp($bismi_allah_request[1], 'account') ? 'bismi_allah_user' : 'bismi_allah_browser', 'bismi_allah', 'bismi_allah_blog');
mysqli_set_charset($db_connection, 'utf8mb4');
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

<?php
if(0 === strcmp($bismi_allah_request[1], ''))
{   // '/'
    echo '<h1>requested \'/\'</h1>';
}
elseif(0 === strcmp($bismi_allah_request[1], 'blogs'))
{   //  '/blogs/{blog_id}'
    if(isset($bismi_allah_request[2]) && 0 !== strcmp($bismi_allah_request[2], ''))
    {
        $blog_id = mysqli_real_escape_string($db_connection ,$bismi_allah_request[2]);
        if(is_numeric($blog_id))
        {
            $query = 'SELECT blog_title, blog_text, blog_next_id, blog_previous_id, user_id FROM bismi_allah_blogs WHERE blog_id=' . $blog_id . ';';
            $query_result = mysqli_query($db_connection, $query);
            if(0 >= mysqli_num_rows($query_result))
            {
                echo '<p style="color: red;"><b>BLOG WAS NOT FOUND</b></p>';
            }
            else
            {
                if($row = mysqli_fetch_assoc($query_result))
                {
                    if($row['user_id'] === $_SESSION['account_id'])
                    {
                        echo '<a href="/account/edit/' . $blog_id . '">edit blog</a><br>';
                    }
                    echo '<article>';
                    echo '<div class="blog_title">' . $row['blog_title'] . '</div>';
                    echo '<p class="blog_text">' . $row['blog_text'] . '</p>';
                    echo '</article>';
                    if(isset($row['blog_next_id']))
                    {
                        echo '<a href="/blogs/' . $row['blog_next_id'] . '">next blog</a> <br>';
                    }
                    if(isset($row['blog_previous_id']))
                    {
                        echo '<a href="/blogs/' . $row['blog_previous_id'] . '">previous blog</a>';
                    }
                }
            }
        }
        else
        {
            echo '<p style="color: red;"><b>BLOG ID IS NOT VALID</b></p>';
        }
    }
}
elseif(0 === strcmp($bismi_allah_request[1], 'users'))
{   //  '/users/{empty_string/user_id}'

    //user_name/_id is set
    if(isset($bismi_allah_request[2]) && 0 !== strcmp($bismi_allah_request[2], ''))
    {
        $user_id = mysqli_real_escape_string($db_connection, htmlspecialchars($bismi_allah_request[2]));

        $query = 'SELECT blog_title, blog_id FROM bismi_allah_blogs WHERE user_id=' . $user_id . ';';
        $query_result = mysqli_query($db_connection, $query);
        if(0 >= mysqli_num_rows($query_result))
        {
            echo '<h1>user either doesn\'t exist or has no blogs</h1>';
        }
        else
        {
            while($row = mysqli_fetch_assoc($query_result))
            {
                echo '<div class="blog_title"><a href="/blogs/' . $row['blog_id'] . '">' . $row['blog_title'] . '</a></div> <br>';
            }
        }
    }
    else
    {
        echo '<h1> browse users </h1>';
        $query = 'SELECT user_id, user_name FROM bismi_allah_users;';
        $query_result = mysqli_query($db_connection, $query);
        if(0 >= mysqli_num_rows($query_result))
        {
            echo '<p>sub7an Allah there are no users</p>';
        }
        else
        {
            while($row = mysqli_fetch_assoc($query_result))
            {
                echo '<div class="users"><a href="/users/' . $row['user_id'] . '">' . $row['user_name'] . '</a></div> <br>';
            }
        }
    }
}
elseif(0 === strcmp($bismi_allah_request[1], 'account'))
{   // '/account/{account_name/"login"/"register"/"edit/{blog_id}"}'
    if(isset($bismi_allah_request[2]))
    {
        if(0 === strcmp($bismi_allah_request[2], ''))
        {
            if(isset($_SESSION['account_name']))
            {
                echo '<h1>hello ' . $_session['account_name'] . '</h1>';
            }
            else
            {
                echo '<a href="/account/login">login</a> <br>';
                echo '<a href="/account/register">register</a> <br>';
            }
        }
        elseif(0 === strcmp($bismi_allah_request[2], 'login'))
        {
            if(isset($_POST['account_name']) && isset($_POST['account_password']))
            {
                $input_account_name = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['account_name']));
            }
            else
            {
                echo '<form method="post" action="/account/login">
                    <label for="account_name">account name</label><input type="text" name="account_name" id="account_name"> <br>
                    <label for="account_password">account password</label><input type="password" name="account_password" id="account_password"> <br>
                    <button type="submit">login</button>
                    </form>';
            }
        }
        elseif(0 !== strcmp($bismi_allah_request[2], 'register'))
        {

        }
        elseif(0 !== strcmp($bismi_allah_request[2], 'edit'))
        {

        }
    }

}
else
{
    echo '<h1>PAGE NOT FOUND</h1>';
}
mysqli_close($db_connection);
?>
<!--
<footer>
    <h6>in the name of Allah</h6>
    <section>
        <h4>Support</h4>
        <ul>
            <li><a href="/support/report_bug"> report a bug</a></li>
        </ul>
    </section>
</footer>
-->
</body>
</html>
