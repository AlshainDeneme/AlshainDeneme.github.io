<?php

# ÆSLANMEDYA
# aslnmedya@gmail.com
# silvertakip.com

session_start();
include "../config.php";
$_ID = $_SESSION['_ID'];
$uyeDetay = DB::getRow("SELECT * FROM users WHERE userid = '{$_ID}'");
$i = new instaAuth;
$_ID = $_POST['id'];
$miktar = $_POST['miktar'];
$mediaData = $i->_cURL("https://api.instagram.com/oembed/?url={$_ID}");
$mediaJSON = json_decode($mediaData);
$mediaID = $mediaJSON->media_id;
if($miktar < $uyeDetay->credi){
	if($uyeDetay->credi > 0)
	{

        $members = array();
        $uyeler = DB::query("SELECT * FROM users ORDER BY RAND() LIMIT $miktar");
        foreach ( $uyeler as $uye )
        {
            $members[] = $uye->username;
		}
		
        try {
			
            $auth = new instaAuth;
            $auth->setCacheFolder("../cookies/");
            $auth->setCacheExtension(".txt");
            $auth->setCookies($members);
            $result = $auth->_doLike($mediaID);
			
        } catch (Exception $e )
        {
           echo  $e->getMessage();
        }
		$yeniMiktar = $uyeDetay->credi - $result->success;
		DB::exec("UPDATE users SET credi = '$yeniMiktar' WHERE userid = ?", array($_SESSION['_ID']));
		$json['message'] = 'Fotoğrafınıza '.$result->success.' adet beğeni gönderildi';
		$json['credit'] = $yeniMiktar;
		DB::insert("INSERT INTO likeLog (`_ID`, `profilpic`, `comment`, `date`) VALUES (?, ?, ?, ?);",
                        array($uyeDetay->username, $uyeDetay->profile, '#<a href="' . $_ID . '" target="_blank">fotoğraf</a>ına <strong>' . $result->success . '</strong> adet beğeni gönderdi.', time()));
	}else{
		$json['message'] = 'Krediniz bitmiştir. Lütfen 12 saat sonra tekrar geliniz.';
		$json['credit'] = $uyeDetay->credi;
	}
}else{
		$json['message'] = 'Girdiğiniz rakam kredinizi aştı.';
		$json['credit'] = $uyeDetay->credi;
}
echo json_encode($json);
?>