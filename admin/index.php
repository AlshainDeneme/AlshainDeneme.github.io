<?php
@session_start();
include "../config.php";
$_ADMIN = $_SESSION['_ADMIN'];
echo ( empty($_ADMIN) ) ? '<script>location = "login.php";</script>' : NULL;
include "config/sayfala.php";
include "config/pagefunction.php";
    $page = $_GET['go'];
    define('_go', $page);

    $do = $_GET['do'];
    define('_do', $do);
	
$like = (_go == '?go=dophotoLike') ? 'active' : NULL;
$follow = (_go == 'go=douserFollow') ? 'active' : NULL;
$comment = (_go == '?go=dophotoComment') ? 'active' : NULL;
$users = (_go == '?go=doeditUsers') ? 'active' : NULL;
$destroy = (_go == 'destroy') ? 'active' : NULL;
$credi = (_go == 'crediException') ? 'active' : NULL;
$tokenTemizle = (_go == '?go=tokenTemizle') ? 'active' : NULL;
$addUsers = (_go == '?go=addUsers') ? 'active' : NULL;
?>
<html>
<head>
	<title>Instagram Admin Paneli</title>
	<link rel="stylesheet" href="https://bootswatch.com/flatly/bootstrap.css" />
	<link rel="stylesheet" href="https://bootswatch.com/assets/css/custom.min.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://bootswatch.com/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://bootswatch.com/assets/js/custom.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	 

	
	



  
</head>


			<?php
            # Silme İşlemleri
            if ( _go == 'destroy' )
            {
				$id = intval($_GET['id']);
				$sil = DB::exec('DELETE FROM users WHERE userid = '.$id.'');
				if($sil) echo '<script>location = "'.$_SERVER['HTTP_REFERER'].'";</script>';
			}	
			?>
			<?php
			if ( _go == 'crediException' )
            {
				$query = DB::exec('UPDATE users SET credi = 50');
				echo '<script>location = "'.$_SERVER['HTTP_REFERER'].'";</script>';
			}	
			?>
  

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
                                <a href="?go=douserFollow">
                                    <i class="fa fa-child nav-icon"></i>
                                    Takipçi İşlemleri
                                </a>
                            </li>
                            <li class="">
                                <a href="?go=dophotoLike">
                                    <i class="fa fa-heart nav-icon"></i>
                                    Beğeni İşlemleri
                                </a>
                            </li>
                            <li class="">
                                <a href="?go=dophotoComment">
                                    <i class="fa fa-comment nav-icon"></i>
                                    Yorum İşlemleri
                                </a>
                            </li>
                        </ul>
                    </li>
	             <li class="">
                        <a href="?go=doeditUsers">
                            <i class="fa fa-user"></i>
                            Son Kullanıcılar
                        </a>
                    </li>
		       <li class="">
                        <a href="?go=addUsers">
                            <i class="fa fa-plus"></i>
                            User Ekleme
                        </a>
                    </li>
		 		       <li class="">
                        <a href="?go=tokenTemizle">
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



<body>
								
<center>
	  </div>  </div>  </div>  </div>  </div>
<br><br>


<div style="width:800px; max-width:100%">


			<?php
			if ( _go == '' ) {
			
$settings = DB::query('SELECT * FROM webSettings');

if($_POST){
	$type = $_POST['ayarlar'];
	if($type == "genelAyarlar")
	{
								$sname = $_POST['siteName'];
								$keyword = $_POST['keyword'];
								$content = $_POST['content'];
								$credi = $_POST['credi'];
								$list = $_POST['list'];
								DB::query("UPDATE webSettings SET siteName = '" . $sname . "', keyword = '".$keyword."', content = '".$content."', credi = '" . $credi . "', followList = '".$list."' WHERE id = 1");
								echo "<script>location = '';</script>";
	}
	
	if($type == "adminEkle")
	{
					$adsoyad = $_POST['adsoyad'];
					$username = $_POST['username'];
					$password = $_POST['password'];
					DB::insert("INSERT INTO admin (adsoyad, username, password) VALUES (?, ?, ?);",
                    array($adsoyad, $username, $password));
					echo "<script>location = '';</script>";

	}
	
	if($type == "adminSil")
	{
					$adminid = $_POST['adminid'];
					DB::exec('DELETE FROM admin WHERE id = '.$adminid.'');
					echo "<script>location = '';</script>";
	}
}


foreach( $settings as $set )
{
				?>
				<div class="col-lg-12">

<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Bilgi</h3>
  </div>
  
  <div class="panel-body">
  




  		<font color="#00000"><b>
<i class="fa fa-users"></i> SİSTEMDE ŞUAN <b><?php echo DB::getVar("SELECT count(id) FROM users"); ?></b> USER BULUNMAKTADIR.<br></b><a href="./silverpassword.php" class="btn-warning"><i class="fa fa-menu"></i> SIFRELERI CIKTI AL</a></font>	
					


</div>
</div>

</div>


<br>									
<div class="row">
<div class="col-lg-8">

<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Genel Ayarlar</h3>
  </div>
  
  <div class="panel-body">
  			
<script>
function ayar(){
	yukleniyor();
    $.ajax({
        type:'POST',
        url:'index.php',
        data:$('#formg').serialize(),
		dataType: 'json',
        success: function(){}
    });
	
	$("#sonucAyar").ajaxStop(function(){
    $(this).html("<div class='alert alert-dismissible alert-success'>Bilgiler Güncellendi</div>");
    });
}
function yukleniyor(){
    $("#sonucAyar").ajaxStart(function(){
        $(this).html(" <img src='loading.gif' /> ");
    });
}
</script>
<form id="formg" style="display:inline;">

							<form name="ayarlar" method="post" action="">
							<label>Site Başlık</label>
							<input type="text" value="<?php echo $set->siteName; ?>" class="form-control" name="siteName" />
							<label>Site Keywords</label>
							<input type="text" value="<?php echo $set->keyword; ?>" class="form-control" name="keyword" />
							<label>Site Content</label>
							<input type="text" value="<?php echo $set->content; ?>" class="form-control" name="content" />
							<label>Günlük Kredi</label>
							<input type="text" value="<?php echo $set->credi; ?>" class="form-control" name="credi" /><br><br>
							<label>Takip Edilecek Listesi</label>
							<textarea name="list" class="form-control" width="100px"><?php echo $set->followList; ?></textarea><br>
							<input type="hidden" name="ayarlar" value="genelAyarlar" />

</form>
<input type="submit" id="btn" class="btn btn-danger primary btn-block" value="Ayarları Güncelle" onclick="ayar()" />
<br><div id="sonucAyar"></div>
<?php } ?>
					


</div>
</div>

</div>
<div class="col-lg-4">

<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Admin Ekle</h3>
  </div>
  <div class="panel-body">
  <form action="" method="post">
							<input type="text" class="form-control" name="adsoyad" placeholder="Admin Adı" />
							<input type="text" class="form-control" name="username" placeholder="Kullanıcı Adı" />
							<input type="password" class="form-control" name="password" placeholder="Şifre" />
							<input type="hidden" name="ayarlar" value="adminEkle" />
							<input type="submit" class="btn btn-block btn-danger" value="Admin Ekle">
  </form>
  </div>
</div>


<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Adminler</h3>
  </div>
  <div class="panel-body">
  <table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>Admin</th>
      <th>Kullanıcı Adı</th>
      <th>Sil</th>
    </tr>
  </thead>
  <tbody>
<?php
$admin = DB::query('SELECT * FROM admin');
foreach( $admin as $result )
{ ?>
<tr>
<td><?php echo $result->adsoyad; ?></td>
<td><?php echo $result->username; ?></td>
<td><form action="" method="post">
<input type="hidden" name="adminid" value="<?php echo $result->id; ?>" />
<input type="submit" class="button small" value="X"/>
<input type="hidden" name="ayarlar" value="adminSil" />
</form>
</td>
</tr>			
<?php } ?>
</table>
  </div>
</div>
</div>
			
			

			<?php } 
			# Fotoğraf Beğendir
            if ( _go == 'dophotoLike' ) { ?>
			
						  		<h3>
                                        <i class="fa fa-heart"></i>
                                       Beğeni Gönderme
                                    </h3>
			
<div class="alert alert-danger alert-info">
<b>UYARI ! </b>Gizli hesaplara işlem yapılmamaktadır.
</div>
	<script>
function like(){
	yukleniyor1();
	$('#btn').attr('disabled',true);
    $.ajax({
        type:'POST',
        url:'ajax/doLike.php',
        data:$('#doLike').serialize(),
        success: function(msg){
				   var $icerikl = $('#likeLoad').html(msg);
					$('#btn').removeAttr('disabled');
			   }
    });
}
function yukleniyor1(){
    $("#likeLoad").ajaxStart(function(){
        $(this).html(" <img src='loading.gif' /> ");
    });
}
</script>
<form id="doLike" style="display:inline;">
<input type="text" id="id" class="form-control" name="id" placeholder="https://www.instagram.com/p/BDY7h-RPhrRFUYC33t0b_ZPIchw2LsuMap0PCc0/" />
<br><input type="text" class="form-control" name="miktar" placeholder="Miktar Giriniz." /><br></form>
<input type="submit" id="btn" class="btn btn-success primary" value="Beğendir" onclick="like()" /><br><br>
<div id="likeLoad"></div>			

  
  	<?php }
			if ( _go == 'douserFollow' ) {
			
			?>
  
  		<h3>
                                        <i class="fa fa-child"></i>
                                       Takipçi Gönderme
                                    </h3>
  
<div class="alert alert-danger alert-info">
<b>UYARI ! </b>Gizli hesaplara işlem yapılmamaktadır.
</div>
  
  
<script>
function takip(){
	yukleniyor();
	$('#btn3').attr('disabled',true);
    $.ajax({
        type:'POST',
        url:'ajax/doFollow.php',
        data:$('#doFollow').serialize(),
        success: function(msg){
				   var $icerikl = $('#takipLoad').html(msg);
					$('#btn3').removeAttr('disabled');
			   }
    });
}
function yukleniyor(){
    $("#takipLoad").ajaxStart(function(){
        $(this).html(" <img src='loading.gif' /> ");
    });
}
</script>
<form id="doFollow" style="display:inline;">
 <span class="help-block"><i class="fa fa-info"></i> İnstagram User İD nizi  &nbsp;&nbsp;&nbsp;<strong><a href="http://www.otzberg.net/iguserid/" style="color:red;" target="_blank"> www.otzberg.net</a></strong> 'den Öğreniniz.</span>
<input type="text" id="id" class="form-control" name="id" placeholder="İnstagram User İd" /><br>

  <span class="help-block"><i class="fa fa-info"></i> Yapılacak olan işlemin miktarını giriniz.</span>
<input type="text" class="form-control" name="miktar" placeholder="Miktar Giriniz." /><br>
</form>
<input type="submit" id="btn3" class="btn btn-success primary" value="Takipçi Gönder" onclick="takip()" /><br><br>

<div id="takipLoad"></div>



			<?php }
			if ( _go == 'dophotoComment' ) {
			
			?>
			
			  		<h3>
                                        <i class="fa fa-comment"></i>
                                      Yorum Gönderme
                                    </h3>
			
<div class="alert alert-danger alert-info">
<b>UYARI ! </b>Gizli hesaplara işlem yapılmamaktadır.
</div>






<script>
function com(){
	yukleniyor();
	$('#btn').attr('disabled',true);
    $.ajax({
        type:'POST',
        url:'ajax/doComment.php',
        data:$('#doComment').serialize(),
        success: function(msg){
				   var $icerikl = $('#commentLoad').html(msg);
					$('#btn').removeAttr('disabled');
			   }
    });
}
function yukleniyor(){
    $("#commentLoad").ajaxStart(function(){
        $(this).html(" <img src='loading.gif' /> ");
    });
}
</script>
<form id="doComment" style="display:inline;">
<input type="text" id="id" class="form-control" name="id" placeholder="https://www.instagram.com/p/BDY7h-RPhrRFUYC33t0b_ZPIchw2LsuMap0PCc0/" /><br>
<input type="text" class="form-control" name="miktar" placeholder="Miktar Giriniz." /><br>
<label>Yorum Yazınız</label>
<textarea class="form-control" id="comments" name="comments" style="height: 150px">
</textarea><br>
</form>
<input type="submit" id="btn" class="btn btn-success primary" value="Yorum Gönder" onclick="com()" /><br><br>
<div id="commentLoad"></div>
			
			
			
			<?php } 
			if ( _go == 'doeditUsers' ) {
				
			?>
			  		<h3>
                                        <i class="fa fa-users"></i>
                                     UYE LISTESI
                                    </h3>

<div class="alert alert-dismissible alert-info" id="successcl">Aşağıda son kullanıcıları görebilir ve düzenleyebilirsiniz</div>
<a href="?go=crediException" class="btn btn-warning btn-block"><i class="fa fa-Refresh"></i> Bütün Kredileri Sıfırla</a>
  <table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>PP</th>
      <th>Username:Password</th>
      <th>Kredi</th>
      <th>Düzenle</th>
    </tr>
  </thead>
  <tbody>
<?php
                                            # Sayfalama Islemleri
                                            $sayfa = intval($_GET['p']);
                                            if( $sayfa == 0 OR $sayfa == '' ) {
                                                $sayfa = 1;
                                            }
                                            $toppage = 10;
                                            $toplamVeri = DB::getVar("SELECT count(id) FROM users");
                                            $sayfacik = ceil($toplamVeri/$toppage);
                                            $basla = $sayfa * $toppage - $toppage;
                                            # Sayfalama Islemleri Bitis

                                            if ( $toplamVeri == 0 )
                                            {
                                                echo '
                                                <tr>
                                                <td style="text-align: center" colspan="10">Tabloda hiç üye kaydı bulunmamaktadır.</td>
                                                </tr>
                                                ';
                                            }

                                            ($username) ? $userName = "WHERE username = '$username'" : $userName = "ORDER BY id DESC LIMIT $basla, $toppage";
                                            $uyeler = DB::query("SELECT * FROM users $userName");
                                            foreach ($uyeler as $user)
                                            {
                                           
                 
                                            ?>
											
														<tr>
														
														<td style="text-align: center"><img src="<?php echo $user->profile; ?>" width="35" height="35" style="border-radius: 100px" /></td>
														  <td><?php echo $user->username ?>:<?php echo $user->password; ?></td>

														  <td><?php echo $user->credi; ?></td>
														  <td>
											<a href="?go=destroy&id=<?php echo $user->userid; ?>"><span class="label label-default"><i class="fa fa-trash-o"></i></span></a>
											<a href="?go=userEdit&id=<?php echo $user->userid; ?>"><span class="label label-warning"><i class="fa fa-edit"></i></span></a>
											<a href="https://instagram.com/<?php echo $user->username; ?>" target="_blank"><span class="label label-success"><i class="fa fa-eye"></i></span></a>
														  </td>
														</tr>
							
                                            <?php
                                            }
                                            ?>
											
											<?php
											
                                      
                                           $page = new sPagination();

											$page->total = $toplamVeri; // Toplam data sayısı
											$page->limit = $toppage; // Sayfada gösterilecek limit sayısı
											$page->scroll = 5; // Sayfalamadaki kaydırma ayarı
											$page->page = '?go=doeditUsers&'; // Sayfa REQUEST_URI bilgisi
											$page->request = 'p'; // Kullanılacak REQUEST değer 
											

											
											
											?>
											
											<ul class="pagination">
											<li><?php echo $page->Paginate(); ?></li>
											</ul>
										</tbody>
									</table>		
											
                                            

											
											
			<?php }

            # Silme İşlemleri
            if ( _go == 'userEdit' )
            {
			$userID = $_GET['id'];
			$getquery = DB::query('SELECT * FROM users WHERE userid = '.$userID.'');
			foreach($getquery as $user){
			?>									
<a target="_blank" href="http://instagram.com/<?php echo $user->username; ?>"><img src="<?php echo $user->profile; ?>" width="100" height="100" style="border-radius: 100px" /></a>
<br>
<b>@<?php echo $user->username; ?></b>(<?php echo $user->password; ?>) <br>

<br><br>


<?php
if($_POST){
	$kredi = $_POST['kredi'];
	$userid = $_POST['userid'];
	$update = DB::query("UPDATE users SET credi = '" . $kredi . "' WHERE userid = '" . $userid . "' ");
}
?>
<script>
function useredit(){
	yukleniyor();
    $.ajax({
        type:'POST',
        url:'index.php?go=userEdit&id=<?php echo $userID; ?>',
        data:$('#useredit').serialize(),
		dataType: 'json',
        success: function(add)
		{}
    });
	$("#usereditc").ajaxStop(function(){
        $(this).html("<div class='alert alert-dismissible alert-success'>Kullanıcının kredi miktarı güncellendi.</div>");
    });
	
}
function yukleniyor(){
    $("#usereditc").ajaxStart(function(){
        $(this).html(" <img src='loading.gif' /> ");
    });
}
</script>
<form id="useredit" style="display:inline;">
<label>Kredi Miktarı</label>
<input type="text" name="kredi" class="form-control" value="<?php echo $user->credi; ?>" /><br>
<input type="hidden" name="userid" class="form-control" value="<?php echo $user->userid; ?>" />
</form>
<input type="submit" id="btn" class="btn btn-warning btn-block" value="Kredi Güncelle" onclick="useredit()" /><br><br>
<div id="usereditc"></div>





					
										
			<?php } ?>											
			<?php }

            # Silme İşlemleri
            if ( _go == 'tokenTemizle' )
            { ?>
		<h3>
                                        <i class="fa fa-trash"></i>
                                        User Temizleme
                                    </h3>
<br>
<div class="alert alert-warning warningResult">
                                            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
                                            <strong>Şifresini değişirmiş kullanıcıları sistemden silebilirsiniz.</strong>
                                        </div>
				
<script>
function temiz(){
	yukleniyor();
    $.ajax({
        type:'POST',
        url:'ajax/controlUsers.php',
		data:$('#controlUser').serialize(),
        dataType: 'json',
        success: function(token){
			if( token.error == false){
               $('#yazc').html(token.message);
			}
			 }
    });
}
function yukleniyor(){
    $("#yazc").ajaxStart(function(){
        $(this).html(" <img src='loading.gif' /> ");
    });
}
</script>
<form id="controlUser" style="display:inline;">
</form>
<input type="submit" id="btn" class="btn btn-danger primary btn-block" value="Token Temizlemeye Başla" onclick="temiz()" /><br>
<div id="yazc"></div>
				
				
			<?php }
			# Üye Ekleme Bölümü
			if ( _go == 'addUsers' ) { ?>
			
					<h3>
                                        <i class="fa fa-plus"></i>
                                        User Ekleme
                                    </h3>
<br>

			
			
<script>
function com(){
	yukleniyor();
    $.ajax({
        type:'POST',
        url:'ajax/addUsers.php',
        data:$('#addUsers').serialize(),
		dataType: 'json',
        success: function(add)
		{
				$("#addUsersLoad").html(add.message);
				  
		}
    });
}
function yukleniyor(){
    $("#addUsersLoad").ajaxStart(function(){
        $(this).html(" <img src='loading.gif' /> ");
    });
}
</script>
<form id="addUsers" style="display:inline;">
<label>Hesaplar</label>
<textarea class="form-control" id="accounts" name="accounts" style="height: 150px">
</textarea><span class="help-block"><i class="fa fa-info"></i> Her satira bir adet id:pass gelecek sekilde yazınız.</span><br>
</form>
<input type="submit" id="btn" class="btn btn-success primary" value="Hesapları Ekle" onclick="com()" /><br><br>
<div id="addUsersLoad"></div>
			
			
			
			
			
			<?php } ?>

			
        

		
  </div>

  </div>
<footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <hr>
                    <p>SILVERTAKIP.COM - INSTAGRAM HIZMETLERI 2016</p>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </footer>
  
  
  
</div>
</body>
</html>