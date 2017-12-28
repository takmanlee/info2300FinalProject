<?php
	if(session_status()==1){
		session_start();
	}

	require_once 'config/config.php';
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		if (isset($_POST['addevent'])){
			$eventname = htmlentities($_POST['eventname']);
			$eventdate = $_POST['eventdate'];
			$eventlocation = htmlentities($_POST['eventlocation']);
			$eventdescription = htmlentities($_POST['eventdescription']);
			$groupvar=$_POST['togroup'];
            foreach($groupvar as $groupID) {
				$result = $mysqli ->query("INSERT INTO `events` VALUES(0, '$eventdescription', '$eventdate', '$eventname', '$groupID', '$eventlocation')");

				print ("The event $eventname was added successfuly!");
			}
		 header("Location: ".$_SESSION["page"]);
		}



?>

<h2>Add an event!</h2>
<form action ="addevent.php" method = "post" enctype="multipart/form-data">
<h3>Event Name:</h3><input type="text" name = "eventname" required><br>
<h3>Event date:</h3><input type="date" name = "eventdate" required ><br>
<h3>Event location:</h3><input type="text" name = "eventlocation" required><br>
<h3>Event description:</h3><textarea name="eventdescription" cols="60" rows="7" required></textarea><br>
<h3>Group hosting:</h3>
	    <?php
            $resultnew = $mysqli->query("SELECT groupID, group_name FROM groups");
            while ($rownew = $resultnew->fetch_row()){
                $groupID = $rownew[0];
                $group_name = $rownew [1];
                echo "<input type='radio' name='togroup[]' value='$groupID' required>$group_name<br>";
            }
            
$mysqli->close();
?>
<input type="submit" name="addevent" value="Submit">
</form>
</body>
</html>
