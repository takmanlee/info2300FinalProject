<?php
    if(session_status()==1){
        session_start();
    }
    if(!isset($_SESSION["name"])){
        $_SESSION["name"]='guest';
    }
$_SESSION["page"]="https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<!DOCTYPE html>
<html>


<head>
    <!-- The character encoding of my website -->
    <meta charset="UTF-8" />	
    
  <!-- This is your external css file for making things pretty -->    
    <link rel="stylesheet" href="css/index_style.css" />    

    <!-- The tiny icon in the topleft of your browser tab -->
    <link rel="icon" href="assets/havenlogo.jpg" />  
    
    <!-- This is the text that appears on the browser tab -->
    <title>Events</title>
</head>


<body>

    <?php include "header.php" ?>


    <div>
        <h1 class="midbanner"> 
            Events
        </h1>

    </div>

    <div class="page-content">
    <!-- Put all the content needed on this page here -->       

    
    <?php if ( ($admin || isset($_SESSION['name'])) && $_SESSION['name']!='guest') {
        include 'addevent.php';
    }?>

    <h2>Check out our upcoming events!</h2>
    <?php
    require_once'config/config.php';
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $result = $mysqli ->query("SELECT * FROM events ORDER BY eventdate asc");
    
    while ($row = $result->fetch_assoc()){
        $eventdate = $row['eventdate'];
        $eventname = $row['event_name'];
        $eventlocation = $row['location'];
        $eventdescription = $row['description'];
        $eventsgroupid = $row['group'];
        //print ("$eventsgroupid");
        $hostgroup = $mysqli->query("SELECT group_name FROM groups WHERE groupID = '$eventsgroupid'");
        $hostgroupresult = $hostgroup ->fetch_assoc();
        $hostgroupresultfinal = $hostgroupresult['group_name'];
        //print ("$hostgroupresultfinal");
        echo '<div class="eventPosts">';
        print ("<br>Event: $eventname<br>");
        print ("Hosted by: $hostgroupresultfinal<br>");
        print ("Date: $eventdate<br>");
        print ("Location: $eventlocation<br>");
        print ("Description: $eventdescription<br><br>");
        echo "</div>";
    }

    ?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="scripts/menu.js"></script>
    </div>
    
    <?php include "footer.php" ?>
    
</body>


</html>