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
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="scripts/menu.js"></script>
    <!-- This is the text that appears on the browser tab -->
    <title>Groups</title>
</head>

<body>

    <?php include "header.php" ?>

        <h1 class="midbanner"> 
            Groups
        </h1>

    <div class="page-content">
    <!-- Put all the content needed on this page here -->        
        
        <?php
        require_once 'config/config.php';
        // include 'addPost.php';
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if(!isset($_GET['group'])){
            $groups = mysqli_query($mysqli, "SELECT * FROM groups ORDER BY groupID ASC") or die(mysqli_error($mysqli));
            while($row = mysqli_fetch_assoc($groups)){
                $text = $row['group_name'];
                echo "<a href='Groups.php?group=$row[groupID]'><div class='groupDiv'>
                    <img src='$row[groupIMG]' alt='$row[group_name]'>
                    <div class='groupName'>
                    <p>$text</p>
                    </div> 
                    </div></a>";
            }
        }
        else{
            $subscribe = 'SUBSCRIBE';
            $group = mysqli_real_escape_string($mysqli, htmlentities($_GET['group']));
            if(substr_count(mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT groupList FROM users WHERE username='$_SESSION[name]'"))['groupList'], "$group")>=1){
                $subscribe = 'UN' . $subscribe;
            }
            $groupinfo = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM groups WHERE groupID = $group"));
            echo "<a style='color: blue;' href='Groups.php'>Back to groups</a>";
            echo "<h2>$groupinfo[group_name]</h2>";
            echo "<p>President: $groupinfo[president]</p>";
            echo "<p>$groupinfo[about]</p>";
            echo "<br><a href='subscribe.php?user=$_SESSION[name]&group=$group'>$subscribe TO THIS GROUP</a><br><br>";
            echo '<div class="slider">
            <a href="#" class="control_next">&gt;</a>
            <a href="#" class="control_prev">&lt;</a>
            <ul>';
            $posts = mysqli_query($mysqli, "SELECT * FROM posts WHERE groupID=$group");
            while($row = mysqli_fetch_assoc($posts)){
                $user = mysqli_query($mysqli, "SELECT username FROM users WHERE users.userID = $row[userID]") or die(mysqli_error($mysqli));
                $author = mysqli_fetch_assoc($user)["username"];
                // if($row['tags']!==''){
                //     $tagIDs = explode(" ", $row['tags']);
                //     $tags = [];
                //     foreach($tagIDs as $tag){
                //         array_push($tags, mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT tag_n
                //     $tagStr = join(", ", $tags);ame FROM tags WHERE tagID = $tag"))['tag_name']);
                //     }
                // }
                $images = [];
                $allImages = mysqli_query($mysqli, "SELECT file_path FROM images WHERE images.postID = $row[postID]") or die(mysqli_error($mysqli));
                while($imrow = mysqli_fetch_assoc($allImages)){
                    array_push($images, $imrow['file_path']);
                }
                echo "<li>\n";
                echo "<h3 class='postTitle'>$row[post_title]</h3>";
                echo "<p class='postBody'>Posted by: $author on $row[date_added]</p>";
                // if($tagStr!==''){
                //     echo "<p class='postBody'>Tags: $tagStr</p>";
                // }
                echo "<p class='postBody'>$row[post_body]</p>";
                if(isset($images[0])){
                    foreach ($images as $image) {
                        echo "<input type='image' class='postImage' src='$image' onclick='superImage(\"$image\")' alt='postImage' >\n";
                    }
                }
                echo "</li>";
                // $tagStr = '';
                $author = '';
                $images = [];
            }
            echo '</ul></div>';
            }
        ?>
                <?php if($_SESSION['name']!='guest') { 
            include 'addposts.php';
        }
        ?>
    </div>

    <?php include "footer.php" ?>
</body>