<?php
	if(session_status()==1){
		session_start();
	}
    if(!isset($_SESSION["name"])){
        $_SESSION["name"]='';
    }
$_SESSION["page"]='AboutUs.php';
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
    <title>About Us</title>
</head>


<body>

    <?php include "header.php" ?>


    <div>
        <h1 class="midbanner"> 
            About Us
        </h1>
    </div>

    <div class="page-content">
    <!-- Put all the content needed on this page here -->        
        <h2>HAVEN</h2>
        <p>Haven is the first and foremost LGBTQ Student Union at Cornell University</p>
        <p>Founded in 2006, Haven looks to be the parent organization to various LGBTQ support groups on campus</p>
        <p>We welcome members any or all of our suborganizations!</p>

        <h3>Meet the President</h3>
        <img src="assets/rsz_ashton.jpg" alt="ashton">
        <p>Ashton is a Sophomore in the College of Arts and Sciences as an Information Science major</p>
        <p>He is so excited to bring in creative ideas for Haven's 2016-2017 year!</p>
        <p>Please feel free to contact us through our webform, or personally reach out at acc328@cornell.edu</p>

    </div>

    <?php include "footer.php" ?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="scripts/menu.js"></script>

</body>


</html>