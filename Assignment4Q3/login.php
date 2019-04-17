<?php
session_start();

$user_input = $_POST['username'];
$password_input = $_POST['password'];

$pattern1 = "/^[a-zA-Z0-9]*$/";
$pattern2 = "/^(?=.*[0-9]+.*)(?=.*[a-zA-Z]+.*)[0-9a-zA-Z]{6,}$/";

if(isset($_POST['login'])){
    if(preg_match($pattern1, $user_input) && preg_match($pattern2, $password_input)){

        $file = fopen('login.txt', 'r');
        while (!feof($file)) {
            $line = fgets($file);
            list($user, $password) = explode(':', $line);
            if (trim($user) == $user_input && trim($password) == $password_input) {
                $_SESSION['login'] = true;
                $_SESSION['username'] = $user_input;
                header('Location: home.php');
                exit();
            } if(trim($user) == $user_input && trim($password) != $password_input){
                echo "Invalid password!";
                break;
            } if(strpos(file_get_contents('login.txt'), $user_input) == false){
                file_put_contents('login.txt', "\n".$user_input. ':'. $password_input, FILE_APPEND);
                    $_SESSION['login'] = true;
                    $_SESSION['username'] = $user_input;
                if (!empty($_SESSION['username'])) echo "Hello, " . $_SESSION['username'] . "!<br>";
                echo "<button onclick=document.location.href=hhome.phpname='return'>Return to search page</button>";
                exit();
            }
        }
        fclose($file);

    }else echo "Invalid login!";

}

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Hotel Reservation Login</title>
    <link rel="stylesheet" type="text/css" href="main.css"/>
    <table>
        <tr >
            <th><a href="home.php">
                    <img src="hotel.jpeg" alt="hotel" width="200" height="150">
                </a></th>
            <th class="header"> Hotel Reservation Form</th>
        </tr>
    </table>
    <form onload="myFunction()" id = "time"></form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        var timestamp = '<?=time();?>';
        function updateTime(){
            $('#time').html(Date(timestamp));
            timestamp++;
        }
        $(function(){
            setInterval(updateTime);
        });

        document.getElementById("time").innerHTML = timestamp;
    </script>
</head>
<body>
<form  method = "post">
    <p>Username: <br>
        <input type="text" name="username">
    </p>

    <p>Password: <br>
        <input type="password" name="password">
    </p>
    <?php  session_destroy();?>
    <button type="submit" name="login">Login</button>
    <p> A username can contain letters (both upper and lower case) and digits only</p>
    <p> A password must be at least 6 characters long (characters are to be letters and
        digits only), have at least one letter and at least one digit</p>
</form>

</body>

<footer> <div id="footer"><a href="disclaimer.html">Privacy/Disclaimer Statement</a></div></footer>
</html>
