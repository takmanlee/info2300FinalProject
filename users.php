<?php
    if(session_status()==1){
        session_start();
    }
    if(!isset($_SESSION["name"])){
        $_SESSION["name"]='guest';
    }
    require_once 'config/config.php';
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if(isset($_SESSION['name'])){
        $admin = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT isAdmin FROM users WHERE username = '$_SESSION[name]'"))['isAdmin'];
    }
    if($admin){
?>
<!DOCTYPE html>
<html>


<head>
    <!-- The character encoding of my website -->
    <meta charset="UTF-8" />	
    
    <!-- This is your external css file for making things pretty -->    
    <link rel="stylesheet" href="css/login_style.css" />	

    <!-- The tiny icon in the topleft of your browser tab -->
    <link rel="icon" href="assets/havenlogo.jpg" />  
    
    <!-- This is the span that appears on the browser tab -->
    <title>Haven: The LGBTQ+ Student Union</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="scripts/super.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="scripts/menu.js"></script>
</head>
<body>

<?php
    require_once 'config/config.php';
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $users = mysqli_query($mysqli, "SELECT * FROM users WHERE NOT username='guest' ORDER BY userID ASC") or die(mysqli_error($mysqli));
    $returnPage = $_SESSION['page'];
    echo '<a href= "'. $returnPage.'"> Return </a>';
    echo '<h3> Create New User </h3>
        <form id="loginForm" name="loginForm" action="users.php" method="post">
            Username: <input type="text" name="username"><br><br>
            Password: <input type="password" name="password"><br><br>
            Is Admin: <input type="checkbox" name="isAdmin" value="admin" />
            <input type="submit">
        </form>';
    while($row = mysqli_fetch_assoc($users)){
        $user = mysqli_query($mysqli, "SELECT username FROM users WHERE users.userID = $row[userID]") or die(mysqli_error($mysqli));
        echo "<div class='userDiv'>\n";
        echo "<h3 class='userName'>$row[username]</h3>";
        echo "Is Admin: $row[isAdmin]<a href='users.php?username=$row[userID]&change=isAdmin'><br> Toggle</a><br>";
        echo "<a href='users.php?username=$row[userID]&change=delete'>Delete User</a>";
        if(isset($images[0])){
            foreach ($images as $image) {
                echo "<input type='image' class='postImage' src='$image' onclick='superImage(\"$image\")' alt='postImage' >\n";
            }
        }
        echo "</div>";
    }
    if(isset($_POST['password'])){
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $username = mysqli_real_escape_string($mysqli, htmlentities($_POST['username']));
        $password = password_hash(mysqli_real_escape_string($mysqli, htmlentities($_POST['password'])), PASSWORD_DEFAULT);
        $admin = 0;
        if(isset($_POST['isAdmin'])){
            $admin = 1;
        }
        mysqli_query($mysqli, "INSERT INTO users VALUES ('$_POST[username]', '$password', $admin, DEFAULT, 1)") or die(mysqli_error($mysqli));
    }
    if(isset($_GET['username'])){
        $username = mysqli_real_escape_string($mysqli, htmlentities($_GET['username']));
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if(isset($_GET['change'])){
            if($_GET['change']=='isAdmin'){
                mysqli_query($mysqli, "UPDATE users SET isAdmin = !isAdmin WHERE userID='$username'") or die(mysqli_error($mysqli));
            }
            else if($_GET['change']=='delete'){
                mysqli_query($mysqli, "DELETE FROM users WHERE userID='$username'");
            }
        }
    }
?>
</body>


</html>
<?
}
if(isset($_SESSION['name'])){
        $admin = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT isAdmin FROM users WHERE username = '$_SESSION[name]'"))['isAdmin'];
    }
if(!$admin){
header("Location: ".$_SESSION["page"]);
}
?>