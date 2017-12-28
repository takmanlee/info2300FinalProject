<?php 
	if(session_status()==1){
		session_start();
	}

	require_once 'config/config.php';
 	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	//$posts = mysqli_query($mysqli, "SELECT * FROM posts WHERE groupID = 1 ORDER BY date_added DESC") or die(mysqli_error($mysqli));
	
    if (isset($_POST['addpost'])){
      //print ("fksdhf;");
        if ((empty($_FILES['attachphoto']['name']))){
          //print ("afuklk");
                            $posttext= htmlentities($_POST['posttext']);
                            $postname= htmlentities($_POST['postname']);
                            $postuser = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT userID FROM users WHERE username = '$_SESSION[name]'"))['userID'];

                            //$groupvar = $_POST['togroup'];
                      //       if(!empty($_POST['togroup'])){
                           	
                           	$groupvar=$_POST['togroup'];
                    		    foreach($groupvar as $groupID) {
                            $result = $mysqli ->query("INSERT INTO `posts` VALUES(DEFAULT, '$postname', '$postuser','$posttext', CURDATE(), $groupID)");
                            
                     //print("The file $postname was uploaded successfully.<br>\n");
                                                  //}
                                             }
										}
                                  
                  
    	if ((!empty($_FILES['attachphoto']['name'] ))) {
                $temp = explode(".",$_FILES["attachphoto"]["name"]);
                $extension = end($temp);


                if($_FILES['attachphoto']['name'] && (!empty($_POST['togroup']))) {
                               
                            $attachphoto = $_FILES['attachphoto']; 
                            $originalName = $attachphoto['name']; 
                            $tempName = $attachphoto['tmp_name'];
                            move_uploaded_file($tempName, "assets/$originalName");
                            $image_URL= "assets/$originalName";
                            $postuser = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT userID FROM users WHERE username = '$_SESSION[name]'"))['userID'];
                            $count = 0;
                            $posttext= htmlentities($_POST['posttext']);
                            $postname= htmlentities($_POST['postname']);

                            $groupvar=$_POST['togroup'];
                            foreach($groupvar as $groupID) {
                            $result = $mysqli ->query("INSERT INTO `posts` VALUES(DEFAULT, '$postname', '$postuser','$posttext', CURDATE(), $groupID)");

                          }

                            $result = $mysqli -> query("SELECT MAX(postID) from posts");
							              while ($row = $result->fetch_assoc()){
							               $count = $row['MAX(postID)'];
							           }
							             $postID = $count;
							             $postdate = GETDATE();
                            $result = $mysqli ->query("INSERT INTO `images` VALUES(0, '$postuser', CURDATE(),'$postID', '$image_URL')");
                            //$imageID = $mysqli->insert_id;

                            
                                                  
                                             
                                  }                          
                      }   
                else {
                       }
       header("Location: ".$_SESSION["page"]);
                  }

           
        //}
        
                        
?>
             
<h2>Add a post!</h2>
<form action="addposts.php" method="post" enctype="multipart/form-data">
<h3>Post name:</h3><input type="text" name="postname" required>  
<br><h3>Post text:</h3><textarea name="posttext" cols="30" rows="3" required></textarea>
<br>
<h3>Choose a group to post to:</h3>

    <?php
            $resultnew = $mysqli->query("SELECT groupID, group_name FROM groups");
            while ($rownew = $resultnew->fetch_row()){
                $groupID = $rownew[0];
                $group_name = $rownew [1];
                echo "<input type='radio' name='togroup[]' value=$groupID required>$group_name<br>";
            }
            
$mysqli->close();
          ?>
<h3>Attach a photo:</h3><input type="file" name="attachphoto">
<input type="submit" name="addpost" value="Submit">
</form>
</body>
</html>