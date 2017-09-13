<?php
@session_start();
include "config.php";
$i = new instaAuth;
$_ID = $_SESSION['_ID'];
$result = json_decode($i->curl_get_file_contents("http://i.instagram.com/api/v1/users/{$_ID}/info/"));
echo ( empty($_ID) ) ? '<script>location = "logout.php";</script>' : NULL;
$uyeDetay = DB::getRow("SELECT * FROM users WHERE userid = '{$_ID}'");
echo ( empty($uyeDetay->id) ) ? '<script>location = "logout.php";</script>' : NULL;
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
    preloader(true, 'dark', 'blue');
  </script>
<style>
@font-face {
    font-family: 'instafont';
    src: url("font/billabong.ttf"); /*URL to font*/
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

    <div class="container">
      <br><br>

	  <div class="row">
	
	   <div class="card">
	   <div class="card-content">
      <center>
	  <img style="border-radius:350px;" src="<?php echo $uyeDetay->profile; ?>"  alt="JustUnfollow İnstagram User Picture" />
	  <br>
	  <h4 class="insta">@<?php echo $uyeDetay->username; ?></h4>
	  <button class="btn red"><i class="fa fa-photo"></i><?php echo $result->user->media_count; ?>Medya</button>
	  <button class="btn blue"><i class="fa fa-users"></i><?php echo $result->user->follower_count; ?>Takipçi</button>
	 <button class="btn pink darken-4"><i class="fa fa-user-plus"></i><?php echo $result->user->following_count; ?>Takip</button>
	 <button class="btn green darken-3"><i class="fa fa-money"></i><span id="kredi_bilgi"><?php echo $uyeDetay->credi; ?>Kredi</span></button>
	
	  <br><br><br>
	  <div class="card blue-grey darken-1"><div class="card-content white-text"> <h4><b>KREDI KAZAN !</b></h4><br>
	  <p>Merhaba,<?php echo $uyeDetay->username; ?>! Referans sistemi ile arkadaşlarınızı bu uygulamaya davet ederek her kişi başına +20 Kredi Kazanın. Alttaki linkten arkadaşlarınızı davet edebilir kredi kazanmaya başlayabilirsiniz. <br>
	  
	  <input type="text" class="form-control" value="http://silvertakip.com/login.php?ref=UC9diVN4pSSve6j26SqEKmPg"></p>
	</div></div>
	  </div>
	   </div>
	 
	   
	   
	   
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
  
  </div></div>
  <footer class="page-footer" style="background-color:#254D77;">
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="orange-text text-lighten-3" href="#">ASLAN MEDYA ©</a> 2016
      </div>
    </div>
  </footer>
  <!--  Scripts-->
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>
  </body>
</html>
