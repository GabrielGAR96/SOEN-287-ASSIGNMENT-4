<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Hotel Reservation </title>
    <link rel="stylesheet" type="text/css" href="main.css"/>

	<table>
		<tr >
			<th><a href="home.php">
             <!--Image source:http://ihg.scene7.com/is/image/ihg/holiday-inn-the-colony-4629618286-4x3-->
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

<body >

<form  method="post" action="search.php">
	<fieldset class="aquabackground"> 
	<legend>Reservation information</legend>
		<label class="lightred"><b>Number of Rooms: </b> </label>
	<input type= "number" name="number">

	<p>
		<form>
		<label class="lightred"> <b>Smoker?</b>  </label>

	<label> Yes </label><input type="radio" name="Yes">
	<label> No </label><input type="radio" name="Yes">


	<p>
		<label class="lightred"><b>Check-in date:</b></label>
		<input type="date" name="chckin">
	</p>

	<p>
		<label class="lightred"><b>Check-out date:</b></label>
		<input type="date" name="chckout">
	</p>
	</fieldset>
	
	<fieldset class="orangebackground">
	<legend>Room specifications</legend>

	<label class="lightblue"><b>Room size:</b> </label>

	<p>
		<label>Small single:</label>
		<input type="checkbox" name="checkbox">
		<label>Regular single:</label>
		<input type="checkbox" name="checkbox">
		<label>Regular double:</label>
		<input type="checkbox" name="checkbox">
		<label>Large single:</label>
		<input type="checkbox" name="checkbox">
		<label>Large double:</label>
		<input type="checkbox" name="checkbox">

    </p>

	<label class="lightblue"><b>Location: </b></label>
	<p>

		<label>Downtown:</label>
		<input type="checkbox" name="downtown" id="downtown" onclick="verifySearch()">
		<label>NDG:</label>
		<input type="checkbox" name="ndg">
		<label>Le Plateau:</label>
		<input type="checkbox" name="plateau">
		<label>Old Montreal</label>
		<input type="checkbox" name="oldMontreal">
		<label> Little Italy:</label>
		<input type="checkbox" name="littleItaly">
		<label>West Island:</label>
		<input type="checkbox" name="westIsland">

    </p>
	<p>
		<label class="lightblue"><b>Price limit:</b></label>
			<select name="prices" onchange="verifySearch()">
				<option value = "50" name = "50" id="fifty">$50</option>
				<option value = "200" name = "200">$200</option>
				<option value = "500" name = "500">$500</option>
				<option >No price limit</option>
			</select>
	</p>

	<p>
		<label class="lightblue"><b>Required parking number:</b></label>
			<select name="price">
				<option>0</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
			</select>
	</p>


	<p>
		<label class="lightblue"><b>Facilities: </b></label>
		<label>Pool:</label>
		<input type="checkbox" name="checkbox">
		<label>Gym:</label>
		<input type="checkbox" name="checkbox">
		<label>Bar:</label>
		<input type="checkbox" name="checkbox">
		<label>Spa:</label>
		<input type="checkbox" name="checkbox">
		<label>Restaurant:</label>
		<input type="checkbox" name="checkbox">
		<label>Massage:</label>
		<input type="checkbox" name="checkbox">



	</fieldset>
	<fieldset id="eSuggestions" class="hidden">
	<legend>Expert Suggestions</legend>
	<label><b>It is very difficult to find a hotel room in this price range at Downtown</b></label>
	</fieldset>


        <button type="submit" name="search">Search</button>
		<input type="reset" name="reset">

	<script type="text/javascript">
		function verifySearch() {
			// body...
			let dt = document.getElementById("downtown").checked;
			let fifty = document.getElementById("fifty").selected;
			if(dt && fifty){
			document.getElementById("eSuggestions").className = "visible";
			}else document.getElementById("eSuggestions").className = "hidden";
		}
		
	</script>
   <p> </p>
</form>
<form action = "login.php" id = "button">
    <?php if(!empty($_SESSION['username'])) echo "Hello, ". $_SESSION['username']."!";  ?>
    <button type="submit">Login</button>

</form>
</body>
<footer> <div id="footer"><a href="disclaimer.html">Privacy/Disclaimer Statement</a></div></footer>
</html>
