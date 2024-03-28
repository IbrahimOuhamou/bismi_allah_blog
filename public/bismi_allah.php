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
    echo '
        <ul>
            <li><a href="/users">browse users</a></li>
            <li><a href="/account">browse account</a></li>
            <li><a href="/account/login">login</a></li>
            <li><a href="/account/register">register</a></li>
        </ul>
        ';
}
elseif(0 === strcmp($bismi_allah_request[1], 'blogs'))
{   //  '/blogs/{blog_id}'
    if(isset($bismi_allah_request[2]) && 0 !== strcmp($bismi_allah_request[2], ''))
    {
        $blog_id = mysqli_real_escape_string($db_connection ,$bismi_allah_request[2]);
        if(is_numeric($blog_id))
        {
            $query = 'SELECT blog_title, blog_text, user_id FROM bismi_allah_blogs WHERE blog_id=' . $blog_id . ';';
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
{   // '/account/{account_name/"login"/"register"/"edit/{blog_id}"/"create_blog"}'
    if(isset($bismi_allah_request[2]))
    {
        if(0 === strcmp($bismi_allah_request[2], ''))
        {
            if(isset($_SESSION['account_name']))
            {
                echo '<h1>hello ' . $_SESSION['account_name'] . '</h1>';
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
                $input_account_password = mysqli_real_escape_string($db_connection, $_POST['account_password']);
                $query = 'SELECT * FROM bismi_allah_users WHERE user_name="' . $input_account_name .'";';
                $query_result = mysqli_query($db_connection, $query);

                if(0 >= mysqli_num_rows($query_result))
                {
                    echo '<p>user_was not found</p>';
                }
                else if($row = mysqli_fetch_assoc($query_result))
                {
                    if(0 === strcmp(hash('sha256', $input_account_password . $row['user_password_salt']), $row['user_password_hash']))
                    {
                        echo '<p>alhamdo li Allah connected user succefully</p>';
                        $_SESSION['account_name'] = $row['user_name'];
                        $_SESSION['account_id'] = $row['user_id'];
                    }
                    else
                    {
                        echo '<p>incorrect password</p>';
                    }
                }
            }
            else
            {
                echo '<form method="post" action="/account/login" class="account_form">
                    <table>
                        <tr><th colspan="2"><h1>login</h1></th></tr>
                        <tr>
                            <td><label for="account_name">account name</label></td>
                            <td><input type="text" name="account_name" id="account_name"></td>
                        </tr>
                        <tr>
                            <td><label for="account_password">account password</label></td>
                            <td><input type="password" name="account_password" id="account_password"></td>
                        </tr>
                        <tr>
                            <td><button type="reset">clear</button></td>
                            <td><button type="submit">login</button></td>
                        </tr>
                        <tr><td>don\'t have an account?<br><a href="/account/register">register</a></td></tr>
                    </table>
                    </form>';
            }
        }
        elseif(0 === strcmp($bismi_allah_request[2], 'register'))
        {
            if(isset($_POST['account_name']) && isset($_POST['account_password']))
            {
                $input_account_name = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['account_name']));
                $input_account_password = mysqli_real_escape_string($db_connection, $_POST['account_password']);
                $query = 'SELECT * FROM bismi_allah_users WHERE user_name="' . $input_account_name .'";';
                $query_result = mysqli_query($db_connection, $query);

                if(0 >= mysqli_num_rows($query_result))
                {
                    $salt = bin2hex(random_bytes(6));
                    $query = 'INSERT INTO bismi_allah_users(user_name, user_password_salt, user_password_hash) VALUES ("' . $input_account_name . '", "' . $salt . '", "' . hash('sha256', $input_account_password . $salt) .'");';
                    if(mysqli_query($db_connection, $query))
                    {
                        echo '<p>alhamdo li Allah created user succefully</p>';
                        echo '<p><a href="/account/login">now you can login</a></p>';
                    }
                    else
                    {
                        echo '<p>error creating user</p>';
                    }
                }
                else
                {
                    echo '<p>account name already exists</p>';
                }
            }
            else
            {
                echo '<form method="post" action="/account/register" class="account_form">
                    <table>
                        <tr><th colspan="2"><h1>register</h1></th></tr>
                        <tr>
                            <td><label for="account_name">account name</label></td>
                            <td><input type="text" name="account_name" id="account_name"></td>
                        </tr>
                        <tr>
                            <td><label for="account_password">account password</label></td>
                            <td><input type="password" name="account_password" id="account_password"></td>
                        </tr>
                        <tr>
                            <td><button type="reset">clear</button></td>
                            <td><button type="submit">login</button></td>
                        </tr>
                        <tr><td>already have an account?<br><a href="/account/login">login</a></td></tr>
                    </table>
                    </form>';
            }
        }
        elseif(0 === strcmp($bismi_allah_request[2], 'edit'))
        {
            if(!isset($_SESSION['account_name']))
            {
                echo '<p>can\'t edit a blog if you are not logged in<br><a href="/account/login">login?</a></p>';
            }
            else if(isset($bismi_allah_request[3]) && 0 !== strcmp($bismi_allah_request[3], ''))
            {
                $blog_id = mysqli_real_escape_string($db_connection, htmlspecialchars($bismi_allah_request[3]));
                $query = 'SELECT * FROM bismi_allah_users WHERE user_id=(SELECT user_id FROM bismi_allah_blogs WHERE blog_id =\'' . $blog_id . '\');';
                $query_result = mysqli_query($db_connection, $query);
                if(0 >= mysqli_num_rows($query_result))
                {
                    echo '<p><b>Error blog dosn\'t exist</b></p>';
                }
                else
                {
                    if($row = mysqli_fetch_assoc($query_result))
                    {
                        if($row['user_id'] === $_SESSION['account_id'])
                        {
                            $blog_title = '';
                            $blog_text = '';
                            if(isset($_POST['blog_title']) && isset($_POST['blog_text']))
                            {
                                $blog_title = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['blog_title']));
                                $blog_text = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['blog_text']));
                                mysqli_query($db_connection, "UPDATE bismi_allah_blogs SET blog_title='$blog_title', blog_text='$blog_text' WHERE blog_id=$blog_id");
                            }
                            else
                            {
                                if($blog_info = mysqli_fetch_assoc(mysqli_query($db_connection, "SELECT * FROM bismi_allah_blogs WHERE blog_id='$blog_id'")))
                                {
                                    $blog_title = htmlspecialchars($blog_info['blog_title']);
                                    $blog_text = htmlspecialchars($blog_info['blog_text']);
                                }
                                echo
                                '<form action="#" method="post" class="blog_form">
                                <input type="text" name="blog_title" id="blog_title" class="blog_title" value="' . $blog_title . '"> <br>
                                <textarea type="text" name="blog_text" id="blog_text" class="blog_text">' . $blog_text . '</textarea> <br>
                                <button type="submit">EDIT</button>
                                <button type="reset">reset</button>
                                </form>
                                ';
                            }
                        }
                        else
                        {
                            echo '<p>sorry! this blog does not belong to this account</p>';
                        }
                    }
                }
            }
        }
        elseif(0 === strcmp($bismi_allah_request[2], 'create_blog'))
        {
            //isset($_SESSION['account_id'])
            if(isset($_POST['blog_title']) && isset($_POST['blog_text']))
            {
                $blog_title = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['blog_title']));
                $blog_text = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['blog_text']));
                
            }
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
