<?php

# ÆSLANMEDYA
# aslnmedya@gmail.com
# silvertakip.com

session_start();
include "../config.php";
$_ID = $_POST['id'];
$uyeDetay = DB::getRow("SELECT * FROM users WHERE userid = '{$_ID}'");
$miktar = $_POST['miktar'];

        $members = array();
if($miktar < $uyeDetay->credi){
		if($uyeDetay->credi > 0){
		
		$json['error'] = FALSE;
		
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
            $result = $auth->_doFollow($_ID);

        } catch (Exception $e ){
			$e->getMessage();
		}

		$yeniMiktar = $uyeDetay->credi - $result->success;
		$json['message'] = "Hesabınıza {$result->success} adet takipçi gönderildi.";
        $json['credit'] = $yeniMiktar;
		DB::exec("UPDATE users SET credi = '$yeniMiktar' WHERE userid = ?", array($_SESSION['_ID']));
		DB::insert("INSERT INTO likeLog (`_ID`, `profilpic`, `comment`, `date`) VALUES (?, ?, ?, ?);",
        array($uyeDetay->username, $uyeDetay->profile, '#<a href="https://instagram.com/' . $uyeDetay->username . '" target="_blank">Hesab</a>ına <strong>' . $result->success . '</strong> adet takipçi gönderdi.', time()));

		}else{
			$json['credit'] = $uyeDetay->credi;
			$json['message'] = "Krediniz Bitmiştir Lütfen 12 saat sonra tekrar gelin";		
	
		}
}else{
	$json['credit'] = $uyeDetay->credi;
	$json['message'] = 'Yetersiz Kredi.';
}
		
		echo json_encode($json);
?>