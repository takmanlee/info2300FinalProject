<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Albums</title>
        <link rel="stylesheet" href="css/main.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
        <script src="scripts/super.js"></script> 
    </head>
    <body>
    <div id="overlay">
        <img id='superimg' onclick='superImage(0)' src='0.jpg' alt=''>
        <table>
        <tr>
        <td>Description<td><td id="descriptionbox"></td>
        </tr>
        <tr>
        <td>Credit<td><td id="creditbox"></td>
        </tr>
        <tr>
        <td>Album Names<td><td id="albumnamebox"></td>
        </tr>
        </table>
    </div>
        <?php include 'includes/login.php';
		$_SESSION["page"]='tags.php';?>
        <h1>Images by Album</h1>
        <?php require_once 'includes/config.php';?>
        <form id="album" action="albums.php" method="get">
            <h3 id="formh3">Album:    </h3>
            <select name="album">
                <?php
                $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                $albums = mysqli_query($mysqli, "SELECT * FROM albums ORDER BY albumID ASC");
                    while($album=mysqli_fetch_assoc($albums)){
                        if(isset($_GET["album"])){
                            if($album["albumID"]==$_GET["album"]){
                                echo "<option selected='selected' value=".$album['albumID'].">".$album["name"]."</option>";
                            }
                            else{
                                echo "<option value=".$album['albumID'].">".$album["name"]."</option>";
                            }
                        }
                        else{
                            echo "<option value=".$album['albumID'].">".$album["name"]."</option>";
                        }
                    }
                ?>
            </select>*
            <input type="submit" value="View Album" name="submit">
        </form>
            <?php
            $valid = false;
            if(isset($_GET["album"])&&is_numeric($_GET["album"])){
                $album = $_GET["album"];
                $valid=true;
            }
            else if (!isset($_GET["album"])){
                $album = 1;
                $valid=true;
            }
            if($valid){
                $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                echo"<div id='albumHeader'>";
                	echo "<h2>".mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM albums WHERE albumID=".$album))["name"]."";
					if(isset($_SESSION["name"]) && $_SESSION["name"]=='admin'&& $album!=1){
							echo "<a href='includes/editAlbum.php?album=".$album."'>Edit Album</a>";
					}
					echo "</h2>";
				echo"</div>";
                echo "<h3>Double Click an Image for Details</h3>";
                echo "<table>";
                echo "<tr><th>Image</th>";
                echo "<th>Description</th>";
                echo "<th>Credit</th></tr>";
                $images = mysqli_query($mysqli, "SELECT DISTINCT * FROM images INNER JOIN ImagesInAlbum ON images.imageID=ImagesInAlbum.imageID WHERE ImagesInAlbum.albumID=".$album." ORDER BY images.imageID ASC");
                while($row = mysqli_fetch_assoc($images)){
                    echo "<tr>";
                    echo "<td class=".$row["imageID"]."><img id='img".$row["imageID"]."' class='listimg' src='".$row["file_path"]."' onclick='superImage(".$row["imageID"].")' alt='image'></td>";
                    echo "<td class=".$row["imageID"].">".$row["description"]."</td>";
                    echo "<td class=".$row["imageID"].">".$row["credit"]."</td>";
                    $albumNamesQuery = mysqli_query($mysqli, "SELECT name FROM albums INNER JOIN ImagesInAlbum ON albums.albumID=ImagesInAlbum.albumID WHERE imageID=".$row["imageID"]." ORDER BY imageID ASC") or die(mysqli_error($mysqli));
                    $albumNamesString='';
                    while($albumIterator = mysqli_fetch_assoc($albumNamesQuery)){
                        $albumNamesString.=$albumIterator["name"].'||';
                    }
                    echo "<td class='hidden' id='hidden".$row["imageID"]."'>".$albumNamesString."</td>"; 
                    if($_SESSION["name"]=='admin'){ 
                        echo "<td>";   
                        echo "<a href='includes/editImage.php?image=".$row["imageID"]."'>Edit Image</a>";
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
             ?>
    </body>
</html>