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
    <title>Contact Us</title>
</head>


<body>
    <?php include "header.php" ?>

    <div class="page-content">
    <!-- Put all the content needed on this page here --> 
    <h1 class="midbanner"> 
            Contact Us
        </h1>
    <div class="descriptionContact">
        <h2>Thanks for visiting!</h2>
        <h4>For any and all suggestions, leave your information and the Haven team 
            will take it into consideration or get back to you as soon as possible.</h4>
        <form action="ContactUs.php" method ="POST">
            Name:<input type="text" name="name" title = "Name" required><br>
            Email:<input type="text" name="email" title = "Email" required><br>
            Suggestion:<textarea name="suggestion" title = "Suggestion" cols="20" rows="2" required></textarea><br>
            <input type="submit" name = "submit" value="submit">
            <input type="reset" name = "reset" value="reset">
        </form>
    </div>
        <div class="pictureContact"><img src="assets/Arthur.jpg" alt="arthur"></div>      
    </div>

 <?php
    if (isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $suggestion = $_POST['suggestion'];
        $to = 'acc328@cornell.edu' . ',';
        $from = $email;
        $subject = 'Suggestion for Haven Club';
        $message = "The information for the suggestion to the Haven Club is as follows:\r\n$name\r\n$email\r\n$phone\r\n$suggestion";

        mail($to, $subject, $message);
        mail($from, $subject, $message);

        if (empty($name)){
            echo "<p>You must provide your name!</p>";
        }

        else if (isset($name)) {
            echo "<p>Name: $name</p>";
        }

        if (empty($email)){
            echo "<p>You must provide your email!</p>";
        }

        else if (isset($email)){
            echo "<p>Email: $email</p>";
        }

        if (empty($phone)){
            echo "<p>You must provide your phone number!<p>";
        }

        else if (isset($phone)){
            echo "<p>Phone: $phone<p>";
        }

        if (empty($suggestion)){
            echo "<p>You must provide an suggestion!";
        }

        else if (isset($suggestion)){
            echo "<p>Suggestion: $suggestion</p>";
        }
    }
?>


    <?php include "footer.php" ?>
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="scripts/menu.js"></script>
</body>


</html>