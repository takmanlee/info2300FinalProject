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
    
    <!-- This is the span that appears on the browser tab -->
    <title>Haven: The LGBTQ+ Student Union</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="scripts/super.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="scripts/menu.js"></script>
</head>


<body onload="checkCookie()">
<div id="overlay">
</div>

    
    <div class="fadeInDiv">
    <?php include "header.php" ?>


    

    <div class="pagePost">
      <h1 class="midbanner"> 
            What's New
      </h1>
      <?php include 'getPosts.php';?>
      

    </div>

    <div class="page-content">
        <div class="description">
            <h1 class="midbanner">About Us</h1>
            <p> Find more about this awesome organization.</p>
            <div class="learn-more"><a href="AboutUs.php">Learn More</a></div>
        </div>
        <div class="picture">
            <img src="assets/OldTeam.jpg" alt="oldTeam">
        </div>
    </div>

    <div class="page-content"> 
        <div class="picture">
            <img src="assets/FilthyDrag.jpg" alt="filthyDrag">
        </div> 
        <div class="description">
            <h1 class="midbanner">Groups</h1>
            <p>This is the groups page of the Haven website. Here we will have a visual listing of all the different suborgs in Haven. These suborg images will be hyperlinked to a GET feature that maps the group class to the URL. From this new URL one can see the specific group's posts and their About Me section. The posts will only be open for edit by logged in Admins.</p>
            <div class="learn-more"><a href="Groups.php">Learn More</a></div>
        </div>
    </div>

    <div class="page-content">
        <div class="description">
            <h1 class="midbanner">Events</h1>        
            <p>This is the events section of the Haven website. Here we will have our upcoming event times, locations, and blurbs. We will also have an interactive google calendar that takes these events, and auto records them in the calendar. This way, site visitors can just add the Haven calendar to their own google calendar through the click of a button.</p>
            <div class="learn-more"><a href="Events.php">Learn More</a></div>
        </div>
        <div class="picture">
            <img src="assets/LGBTRCTabling.jpg" alt="tabling">
        </div>
    </div>


   
    <div>
    <?php include 'footer.php' ?>
    </div>
</div>

     <div class="fadeOutDiv"></div>
</body>


</html>