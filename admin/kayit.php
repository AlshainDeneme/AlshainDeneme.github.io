<?php
include "../config.php";
include "../config/timeclass.php";
?>
<html>
<head>
	<link rel="stylesheet" href="https://bootswatch.com/flatly/bootstrap.css" />
	<link rel="stylesheet" href="https://bootswatch.com/assets/css/custom.min.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
</head>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
       <img src="./img/logo.png" alt="instagram takipci hilesi"> 
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
	   <li class="">
                        <a href="index.php">
                            <i class="fa fa-home"></i>
                            Anasayfa
                        </a>
                    </li>
	   
	    <li class="dropdown ">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                            <i class="fa fa-instagram"></i>
                            İşlemler
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Genler İşlemler</li>
                            <li class="">
                                <a href="index.php?go=douserFollow">
                                    <i class="fa fa-child nav-icon"></i>
                                    Takipçi İşlemleri
                                </a>
                            </li>
                            <li class="">
                                <a href="index.php?go=dophotoLike">
                                    <i class="fa fa-heart nav-icon"></i>
                                    Beğeni İşlemleri
                                </a>
                            </li>
                            <li class="">
                                <a href="index.php?go=dophotoComment">
                                    <i class="fa fa-comment nav-icon"></i>
                                    Yorum İşlemleri
                                </a>
                            </li>
                        </ul>
                    </li>
	             <li class="">
                        <a href="index.php?go=doeditUsers">
                            <i class="fa fa-user"></i>
                            Son Kullanıcılar
                        </a>
                    </li>
		       <li class="">
                        <a href="index.php?go=addUsers">
                            <i class="fa fa-plus"></i>
                            User Ekleme
                        </a>
                    </li>
		 		       <li class="">
                        <a href="index.php?go=tokenTemizle">
                            <i class="fa fa-user-times"></i>
                            User Temizleme
                        </a>
                    </li>
					 <li class="">
                        <a href="./kayit.php">
                            <i class="fa fa-clock-o"></i>
                           İşlem Kayıtları
                        </a>
                    </li>
		 		 		       <li class="">
                        <a href="logout.php">
                            <i class="fa fa-sign-out"></i>
                            Çıkış Yap
                        </a>
                    </li>
  
    </div>
  </div>
</nav>
<CENTER><h1>İŞLEM KAYITLARI</H1></CENTER>
<?php
$query = DB::query('SELECT * FROM likeLog ORDER BY ID DESC LIMIT 70');
foreach( $query as $islem )
{ 
$zaman = date('d.m.Y H:i:s');
$time = $islem->date;
$sonzaman = zamanla($zaman,$time);
?>
<div class="alert alert-dismissible alert-warning">
<img src="<?php echo $islem->profilpic; ?>" width="30px"/>
<?php echo $islem->_ID; ?><?php echo $islem->comment; ?> - <?php echo $sonzaman; ?>
</div>
<?php } ?>
</html>