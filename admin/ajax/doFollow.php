<?php
session_start();
include "../../config.php";
$i = new instaAuth;
$_ID = $_POST['id'];
$miktar = $_POST['miktar'];
if($_ID & $miktar){
        $members = array();
        $uyeler = DB::query("SELECT * FROM users ORDER BY RAND() LIMIT $miktar");
        foreach ( $uyeler as $uye )
        {
            $members[] = $uye->username;
		}
		
        try {
			
            $auth = new instaAuth;
            $auth->setCacheFolder("../../cookies/");
            $auth->setCacheExtension(".txt");
            $auth->setCookies($members);
            $result = $auth->_doFollow($_ID);
			echo "<br><div class ='alert alert-dismissible alert-success'> {$result ->success} Takipçi Gönderildi</div>";
        } catch (Exception $e)
        {
           echo  $e-> getMessage();
        }
}else{
	echo "<br><div class='alert alert-dismissible alert-danger'>Lütfen formu doldurunuz.</div>";
}
?>

