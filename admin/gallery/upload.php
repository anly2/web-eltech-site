<?php	
	require('../templates/header.php');
	require('../config.php');
?>
<?php
	if (($_FILES["file"]["type"] == "image/gif")
		|| 	($_FILES["file"]["type"] == "image/jpeg")
		|| 	($_FILES["file"]["type"] == "image/pjpeg")
		|| 	($_FILES["file"]["type"] == "image/png")){
			if ($_FILES["file"]["error"] > 0){
				echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
			}
			else{
				echo "Upload: " . $_FILES["file"]["name"] . "<br />";
				echo "Type: " . $_FILES["file"]["type"] . "<br />";
				echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
				echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
					if (file_exists("upload/" . $_FILES["file"]["name"])){
						echo $_FILES["file"]["name"] . " already exists. ";
					}
					else{
						move_uploaded_file($_FILES["file"]["tmp_name"],
						"../../gallery_images/" . $_FILES["file"]["name"]);
						global $name;
						$name=$_FILES["file"]["name"];
						function createThumb($name){
							$starting_image = imagecreatefromjpeg("../../gallery_images/".$name);
							$width = imagesx($starting_image);
							$height = imagesy($starting_image);
							$thumb_width = 146;
							$constant = $width/$thumb_width;
							$thumb_height = round($height/$constant, 0);
							$thumb_image = imagecreatetruecolor($thumb_width, $thumb_height);
							imagecopyresampled($thumb_image, $starting_image, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
							imagejpeg($thumb_image, "../../gallery_thumbnails/thumb_".$name);
						}
						createThumb($name);
						mysql_query("INSERT INTO gallery (img_name, path, tmb_path)
									VALUES ('$name', 'gallery_images/'$name,'gallery_thumbnails/thumb'$name)");
						echo "Stored in: " . "upload/" . $_FILES["file"]["name"]."<br/>";
					}
			}
	}
	else{
		echo "Invalid file";
	}
?>