<?php
session_start();
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
    preloader(true, 'white', 'blue');
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

    <div class="nav-wrapper container black-text"><a id="logo-container" href="#" class="brand-logo insta " ><i class="fa fa-instagram"></i> SilverTakip</a>
	<a href="#" class="button-collapse " data-activates="mobile-demo"><i class="material-icons right">reorder</i></a>
    <ul class="right hide-on-med-and-down">
	<li><a href="Anasayfa"><i class="fa fa-home"></i> <span>Anasayfa</span></a></li>
	  <li><a href="Takipci"><i class="fa fa-users"></i> Takipçi Kazan</a></li>
	  <li><a href="Begeni"><i class="fa fa-heart-o"></i> Beğeni Gönder</a></li>
	  <li class="active"><a href="Unf"><i class="fa fa-user-times"></i> Unfollow Yap</a></li>
	  <li><a href="logout.php"><i class="fa fa-close"></i> Çıkış Yap</a></li>
    </ul>
	 
	<ul class="side-nav" id="mobile-demo">
					<li ><a href="Anasayfa"><i class="fa fa-home"></i> <span>Anasayfa</span></a></li>
					<li ><a href="Takipci"><i class="fa fa-users"></i> <span>Takipçi Kazan</span></a></li>
					<li ><a href="Begeni"><i class="fa fa-heart-o"></i><span>Beğeni Artırma</span></a></li>
					<li class="active"><a href="Unf"><i class="fa fa-user-times"></i><span>Unfollow Yap</span></a></li>
					<li ><a href="Kredi"><i class="fa fa-star"></i><span>Ücretsiz Kredi</span></a></li>
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
	<div class="card blue-grey darken-1"><div class="card-content white-text"> 
	Aşağıda sizi takip etmeyenler listelendi. Krediniz kadar sistemimiz üzerinden takibi bırakma işlemini yapabilirsiniz.
	</div></div>
<div class="row">
<?php
$sayi = 0; $count = 100;
$followers = json_decode($i->followers($_ID, $uyeDetay->username, $count));
$followeds = json_decode($i->followed($_ID, $uyeDetay->username, $count));
foreach ($followers as $follower){ $userFollowers[] = $follower->pk; }
foreach( $followeds as $user ){ $isFollowed = in_array($user->pk, $userFollowers);
if (!$isFollowed){ $sayi++;
?>	
<script>function is<?php echo $sayi; ?>(){
$('#u<?php echo $sayi; ?>').animate({ opacity: "hide" }, 0);
    $.ajax({
        type:'POST',
        url:'ajax/doUnfollow.php',
        data: $('#form<?php echo $sayi; ?>').serialize(),
		dataType: 'json',
        success: function(unfollow){
			if ( unfollow.error == false )
                    {
					          $("#kredi_bilgi").text(unfollow.credit + 'Kredi');
			   }else{
				    $('#u<?php echo $sayi; ?>').animate({ opacity: "show" }, 1);
					  $('#yaz<?php echo $sayi; ?>').html('<a style="color:red">' + unfollow.message + '</a>');
			   }
		}
    });
 
}
</script>
<div id="u<?php echo $sayi; ?>">
	<div class="col s12 m4">
	 <div class="card small">
    <div class="card-image waves-effect waves-block waves-light">
      <img class="<?php echo $user->username; ?>" src="<?php echo $user->profile_pic_url; ?>">
    </div>
    <div class="card-content">
	<div id="yaz<?php echo $sayi; ?>">
      <span class="card-title activator grey-text text-darken-4"><?php echo $user->username; ?></span><br>
	  <form id="form<?php echo $sayi; ?>" style="display:inline;">
	  <input type="hidden" value="<?php echo $user->pk; ?>" name="id" />
	  <input type="hidden" value="<?php echo $user->pk; ?>" name="followers" />
	  </form>
	  <input type="submit" id="btn" class="btn btn-success primary" value="Takibi Bırak" onclick="is<?php echo $sayi; ?>()" />
	</div>
	</div>
  </div>
 </div>          
</div>	
<?php } } ?>	
	  </div>
	   </div> </div>
	   
	   <br><br>
   <div class="card">
	   <div class="card-content">
  <center>
<a href="./Kredi"><img src="silver/images/banner.gif"></a></center>
                                            
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
