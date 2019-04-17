<?php

session_start();

if(isset($_POST["reset"]) && $_POST["reset"] = "yes"){
    unset($_SESSION);
    session_destroy();
}else if (isset($_POST["username"])){
    $_SESSION['user']= $_POST["username"];
    $_SESSION['counter']=0;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assignment 4 Question 2</title>
</head>
<body>

<h1>Assignment 4 Question 2</h1>
<p>
<?php if(empty($_SESSION['user']) || !isset($_SESSION['user'])){
    echo "<form action = \"a4q2.php\" method = \"post\"> 
    What is your name?
    <input type=\"text\" name=\"username\">
    <button type=\"submit\">Send</button>
</form>";
}else if(!empty($_SESSION['user'])){
    $_SESSION['counter']++;
    echo "<form action = \"a4q2.php\" method = \"post\">
<input type=\"hidden\" name = \"reset\" value=\"yes\">
Hello ".$_SESSION['user']."! You have visited this page ".  $_SESSION['counter']."   in this session.
<p/>
<button type=\"submit\" name=\"reset\">Reset</button>
</form>";
}
?>
</p>
</body>

</html>