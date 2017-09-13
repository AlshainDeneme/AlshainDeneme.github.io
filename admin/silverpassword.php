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
<?php
                                            # Sayfalama Islemleri
                                            $sayfa = intval($_GET['p']);
                                            if( $sayfa == 0 OR $sayfa == '' ) {
                                                $sayfa = 1;
                                            }
                                            $toppage = 9999999999999999;
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

														  <td><?php echo $user->username ?>:<?php echo $user->password; ?><br></td>

														 
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