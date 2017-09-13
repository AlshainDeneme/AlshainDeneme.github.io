<?php
session_start();
include "../config.php";
$i = new instaAuth;
$_SESID = $_SESSION['_USERNAME'];
$uyeDetay = DB::getRow("SELECT * FROM users WHERE username = '{$_SESID}'");
$ID = $_POST['id'];
	if($uyeDetay->credi > 0)
	{
		try {
				$auth = new instaAuth;
				$auth->setCacheFolder("../cookies/");
				$auth->setCacheExtension(".txt");
				$auth->setCookies(array($uyeDetay->username));
				$result = $auth->_doFollow($ID, TRUE);
				$result = $result->success;
				
		} catch (Exception $e )
		{
			    $e->getMessage();
		}
		if($result == 1)
		{
			$json['error'] = FALSE;
			$json['message'] = "Bu hesaptan başarıyla takipten çıktınız.";
			$yeniMiktar = $uyeDetay->credi - $result;
			$json['credit'] = $yeniMiktar;
		}else{
			$json['error'] = TRUE;
			$json['message'] = "Bir hata oluştu. Takipten çıkamadınız.";
			$yeniMiktar = $uyeDetay->credi;
			$json['credit'] = $uyeDetay->credi;
		}
					
		DB::exec("UPDATE users SET credi = '$yeniMiktar' WHERE userid = ?", array($_SESSION['_ID']));
	}else{
			$json['message'] = 'Krediniz bitmiştir. Lütfen 12 saat sonra tekrar geliniz.';
	}
echo json_encode($json);
?>