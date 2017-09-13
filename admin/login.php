<?php
session_start();
@include "../config.php";
(isset($_SESSION['_ADMIN'])) ? header("Location: index.php") :  NULL;

if ( $_POST ){
    $loginEmail = htmlspecialchars($_POST['username']);
    $loginSifre = htmlspecialchars($_POST['password']);
    $girisKontrol = DB::getVar("SELECT count(id) FROM admin WHERE username = ? and password = ?", array($loginEmail, $loginSifre));
    if ( $girisKontrol > 0 ){
        $_SESSION['_ADMIN'] = $loginEmail;
        header("Location: index.php");
    } else {
        echo '<script>alert("HATA");</script>';
    }
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Silvertakip.com - Admin Paneli</title>
  <link rel="stylesheet" href="css/style.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
  <form action="" method="post" class="sign-up">
    <h1 class="sign-up-title">SILVERTAKIP</h1>
<input type="text" class="sign-up-input" name="username" placeholder="Kullanıcı Adı" /><br><br>
<input type="password" class="sign-up-input" name="password" placeholder="Şifre" /><br><br>
<input type="submit" class="sign-up-button" value="Giriş" />
  </form>
 
 

  <div class="about">
    <p class="about-links">
      <a href="index.php" target="_parent">ANASAYFA</a>
      <a href="http://silvertakip.com/" target="_parent">ILETISIM</a>
    </p>
    <p class="about-author">
      &copy; 2016 <a href="http://silvertakip.com" target="_blank">SILVERTAKIP INSTAGRAM SCRIPTI</a> 
    </p>
  </div>
</body>
</html>
