<?php
session_start();
include "../../config.php";
$i = new instaAuth;
$_ID = $_POST['id'];
$miktar = $_POST['miktar'];
$comments = $_POST['comments'];
$list = explode("\n", $comments);
foreach ( $list as $yorum )
{
$comment[] = str_replace(array("\r"), NULL, trim($yorum));
}
if($miktar & $comments & $_ID){
$mediaData = $i->_cURL("https://api.instagram.com/oembed/?url={$_ID}");
$mediaJSON = json_decode($mediaData);
$mediaID = $mediaJSON->media_id;
        $members = array();
        $uyeler = DB::query("SELECT * FROM users ORDER BY RAND() LIMIT {$miktar}");
        foreach ( $uyeler as $uye )
        {
            $members[] = $uye->username;
		}
		
        try {
			
            $auth = new instaAuth;
            $auth->setCacheFolder("../../cookies/");
            $auth->setCacheExtension(".txt");
            $auth->setCookies($members);
            $result = $auth->_doComment($mediaID, $comment);
			echo "<br><div class='alert alert-dismissible alert-success'>{$result->success} yorum gönderildi</div>";
        } catch (Exception $e )
        {
           echo  $e->getMessage();
        }
}else{
	echo "<br><div class='alert alert-dismissible alert-danger'>Lütfen Formu doldurunuz.</div>";
}
?>