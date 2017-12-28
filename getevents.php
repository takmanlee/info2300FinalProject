<?php
	if(session_status()==1){
		session_start();
	}
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$userGroups = explode(" ", mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT groupList FROM users WHERE userID=(SELECT userID FROM users WHERE username = '$_SESSION[name]')"))['groupList']);
	$allUserPosts = [];
	foreach($userGroups as $group){
		$posts = mysqli_query($mysqli, "SELECT * FROM posts WHERE groupID=$group");
		while($row = mysqli_fetch_assoc($posts)){
			array_push($allUserPosts, $row);
		}
	}
	echo '<div class="slider">
		<a href="#" class="control_next">&gt;</a>
  		<a href="#" class="control_prev">&lt;</a>
  		<ul>';
	foreach($allUserPosts as $row){
		$user = mysqli_query($mysqli, "SELECT username FROM users WHERE users.userID = $row[userID]") or die(mysqli_error($mysqli));
		// if($row['tags']!==''){
		// 	$author = mysqli_fetch_assoc($user)["username"];
		// 	$tagIDs = explode(" ", $row['tags']);
		// 	$tags = [];
		// 	foreach($tagIDs as $tag){
		// 		array_push($tags, mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT tag_name FROM tags WHERE tagID = $tag"))['tag_name']);
		// 	}
		// 	$tagStr = join(", ", $tags);
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
		// 	echo "<p class='postBody'>Tags: $tagStr</p>";
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
	echo '</ul></div>'
?>