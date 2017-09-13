<?php
session_start();
include "../../config.php";
$accounts = addslashes(trim($_POST['accounts']));
$array = explode("\n", $accounts);
$auth = new instaAuth;
$auth->setCacheFolder("../../cookies/");
$auth->setCacheExtension(".txt");
if($accounts)
{
	$json['error'] = FALSE;
	$success = 0;
	foreach ( $array as $list )
    {

            try {

                $list = str_replace("\r", "", $list);
                $parcala = explode(":", $list);
                $username = trim($parcala[0]);
                $password = trim($parcala[1]);
				
				if($username & $password)
				{
					$login = $auth->_authLogin($username, $password);
					if( $login->status == 'ok')
					{
						$userid = $login->logged_in_user->pk;
						$result = json_decode($auth->curl_get_file_contents("http://i.instagram.com/api/v1/users/{$userid}/info/"));
						$userKontrol = DB::getVar("SELECT count(id) FROM users WHERE userid = '" . $userid . "' AND username = '" . $login->logged_in_user->username . "' ORDER BY id DESC");
						
						if ( $userKontrol == 0 )
						{
							DB::insert("INSERT INTO users (userid, username, password, fullname, profile, credi, cookie) VALUES (?, ?, ?, ?, ?, ?, ?);",
							array($result->user->pk, $result->user->username, $password, $result->user->full_name, $result->user->profile_pic_url, '100', '1'));
                        } else {
							DB::query("UPDATE users SET username = '" . $result->user->username . "', fullname = '".$result->user->full_name."', password = '$password', profile = '" . $result->user->profile_pic_url . "' WHERE userid = '" . $result->user->pk . "' ");
						}
						
						$success++;
					}
					
					
				}
				}catch(Exception $e)
				{	
						$e->getMessage;
				}
				$json['message'] = "<div class='alert alert-dismissible alert-warning'>Gönderdiğiniz <strong>" . count($array) ."</strong> hesaptan <strong>" . $success . "</strong> tanesi sistemimize eklendi.</div>";
	}
	}else{
		$json['message'] = "<div class='alert alert-dismissible alert-danger'>Lütfen Formu tamamen doldurunuz.</div>";
	}
	echo json_encode($json);
?>