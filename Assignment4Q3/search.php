<?php
session_start();


?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Hotel Reservation Search</title>
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
<h3>Search results: </h3>
<fieldset>
<?php

$file = file_get_contents('hotel.txt');
$rows = explode("\n", $file);
array_shift($rows);

$downtown = $_POST['downtown'];
$ndg = $_POST['ndg'];
$plateau = $_POST['plateau'];
$oldMontreal = $_POST['oldMontreal'];
$littleItaly = $_POST['littleItaly'];
$westIsland = $_POST['westIsland'];


foreach($rows as $row => $data)
{

    $row_data = explode(":", $data);


    $info[$row]['name'] = $row_data[0];
    $info[$row]['location'] = $row_data[1];
    $info[$row]['street'] =  $row_data[2];
    $info[$row]['price'] = $row_data[3];




    if((isset($_POST['downtown']) && $info[$row]['location'] == 'Downtown'
            || isset($_POST['ndg']) && $info[$row]['location'] == 'NDG'
            || isset($_POST['plateau']) && $info[$row]['location'] == 'Plateau'
            || isset($_POST['oldMontreal']) && $info[$row]['location'] == 'Old Montreal'
            || isset($_POST['littleItaly']) && $info[$row]['location'] == 'Little Italy'
            || isset($_POST['westIsland']) && $info[$row]['location'] == 'West Island')&&
        ($_POST['prices'] == "No price limit" || $_POST['prices'] >= $info[$row]['price'])){
        if(!empty($_SESSION['login'])){
            echo 'Hotel ' . ($row+1) .':<br>';
            echo 'NAME: ' . $info[$row]['name'] . '<br />';
            echo 'LOCATION: ' . $info[$row]['location'] . '<br />';
            echo 'STREET: ' . $info[$row]['street'] . '<br />';
            echo 'PRICE: '. $info[$row]['price'].'<br />';
            echo '<br/>';
        }else{
            echo '<p>Hotel ' . ($row + 1) . ' LOCATION: ' . $info[$row]['location'] . '<br />';

            echo "<form action = \"login.php\">
                <button type=\"submit\">Login to show the full address</button>

            </form></p>";
            ?> <form action = "login.php" id = "button">
                <button type="submit">Login</button>

            </form><?php
        }
    }


}


?>
</fieldset>
</body>
</html>



