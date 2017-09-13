<?php

# ÆSLANMEDYA
# aslnmedya@gmail.com
# silvertakip.com

session_start();
include "config.php";
(isset($_SESSION['_ID'])) ? header("Location: takipciKazan") :  NULL;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title><?php echo $webSettings->siteName; ?></title>
  <meta name="description" content="<?php echo $webSettings->content; ?>"/>
     <meta name="keywords" content="<?php echo $webSettings->keyword; ?>" />

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/preloader.min.css" />
  <script src="js/jquery.js"></script>
  <script src="js/preloader.min.js"></script>
</head>
<body>
  <script>
    preloader(true, 'white', 'blue');
  </script>
<nav role="navigation" style="background-color:#254D77;">

    <div class="nav-wrapper container black-text"><a id="logo-container" href="#" class="brand-logo insta " ><i class="fa fa-instagram"></i>SilverTakip</a>
	<a href="#" class="button-collapse " data-activates="mobile-demo"><i class="material-icons right">reorder</i></a>
    <ul class="right hide-on-med-and-down">
	<li class="active"><a href="Anasayfa"><i class="fa fa-home"></i> <span>Anasayfa</span></a></li>
	  <li><a href="Takipci"><i class="fa fa-users"></i> Takipçi Kazan</a></li>
	  <li><a href="Begeni"><i class="fa fa-heart-o"></i> Beğeni Gönder</a></li>
	  <li><a href="Unf"><i class="fa fa-user-times"></i> Unfollow Yap</a></li>
	  <li><a href="logout.php"><i class="fa fa-close"></i> Çıkış Yap</a></li>
    </ul>
	 
	<ul class="side-nav" id="mobile-demo">
					<li class="active"><a href="Anasayfa"><i class="fa fa-home"></i> <span>Anasayfa</span></a></li>
					<li ><a href="Takipci"><i class="fa fa-user"></i> <span>Takipçi Kazan</span></a></li>
					<li ><a href="Begeni"><i class="fa fa-thumbs-up"></i><span>Beğeni Artırma</span></a></li>
					<li ><a href="Unf"><i class="fa fa-user-times"></i><span>Unfollow Yap</span></a></li>
					<li ><a href="Unf"><i class="fa fa-star"></i><span>Ücretsiz Kredi</span></a></li>
					<li ><a href="logout.php"><i class="fa fa-close"></i><span>Çıkış Yap</span></a></li>
					
           
	</ul>
	
	</div>
</nav>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">Hesabınızı onaylayınız.</h1>
      <div class="row center">
        <h5 class="header col s12 light">Merhaba, sistem sizi ara ara bu sayfaya atabilir bunun nedeni instagram üzerinde hesabınızı onaylamanızın gerekmesidir. Lütfen <strong><a href="https://instagram.com" target="_blank">www.instagram.com</a></strong>  adresine giriş yapınız ve hesabınızı aşağıdaki görseldeki gibi onaylayınız<br><br>
<img src="css/check.png" width="300px"><img src="css/check2.png" width="370px"><br>
        </h5>
      </div>
      <div class="row center">
        <a href="login.php#auth_login=scope=likes,relationship,comment=get?p%pyramidchannel.com" id="download-button" class="waves-effect waves-light btn blue darken-1 btn-large">Instagram İle Giriş Yap</a>


 <a href="https://instagram.com" id="download-button" class="btn-large waves-effect waves-light orange darken3" target="_blank">Instagram Sitesine Git</a>

      </div>
      <br><br>

    </div>
  </div>
<style>
@font-face {
    font-family: 'instafont';
    src: url("fonts/billabong.ttf"); /*URL to font*/
}
.insta {
    font-family: 'instafont';
}
.insta-li{
    font-family: 'instafont';
	font-size: 1.5em;
	color: #125688;
}
</style>

  <div class="container">

    <br><br>

   <div class="card">
	   <div class="card-content">
  <div class="offer-content" style="text-align: left">
                                                <h3 class="lead">
                                                    Bilgilendirme;
                                                </h3>
                                                <p>
                                                    Sitemiz <b>takibe takip (havuz sistemi)</b> şeklinde çalışır , Sitemize girdikten sonra siz de başka kişileri ve fotoğrafları beğenmeyi kabul etmiş sayılırsınız. Beğendiniz ve takip ettiğiniz profiller tamamen gerçek ve normal profillerdir. Müstehcen içerikli profilleri iletişim bölümünden bize bildirebilirsiniz.
                                                </p>
                                            </div>
	    </div>
	    </div>
        
  </div>

    <footer class="page-footer" style="background-color:#254D77;">
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="orange-text text-lighten-3" href="#">ASLAN MEDYA ©</a> 2016
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
