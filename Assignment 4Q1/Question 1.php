<?php
$pattern1 = "/^[A-Za-z]{0,30}$/";
$pattern2 = "/^\(\d{3}\)-\d{3}-\d{4}$/";

$name = $_POST["name"];
$number = $_POST["number"];

echo "Hello, " . $name . "! <br>";

if(preg_match($pattern2, $number) && preg_match($pattern1, $name)) {
    echo "The format of the name and number is correct.";
} else {
    echo "The format of the name or number is not correct.";
}

