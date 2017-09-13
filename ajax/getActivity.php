<?php 
session_start();
include "../config.php";
$username = $_SESSION['_USERNAME'];
$auth = new instaAuth;
$medias = json_decode($auth->getMedia($username));
foreach($medias->items as $media){ ?>
	<img src="<?php echo $media->images->standard_resolution->url; ?>" /><br>
	<a href="<?php echo $media->link; ?>">Git</a>
	<br><br><br>
<?php } ?>