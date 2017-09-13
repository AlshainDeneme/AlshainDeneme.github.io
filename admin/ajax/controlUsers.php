<?php
session_start();
include "../../config.php";
 $result = 0;
 $uyeler = DB::query("SELECT * FROM users ORDER BY RAND()");
 $json['error'] = FALSE;
                            foreach ( $uyeler as $uye )
                            {
                                try {

                                    # İnstagram Oauth
                                    $auth = new instaAuth;
                                    $auth->setCacheFolder("../../cookies/");
                                    $auth->setCacheExtension(".txt");
									$auth->setProxy(json_decode('[]', TRUE));
                                    $login = $auth->_authLogin($uye->username, $uye->password);
									if($login->status == 'fail'){
									unlink('../../cookies/' . $uye->username . $auth->getCacheExtension());
                                    DB::exec('DELETE FROM users WHERE userid = '.$uye->userid.'');
									$result++;
									}
                                    
									
                                } catch (Exception $e )
                                {
                                   unlink('../../cookies/' . $uye->username . $auth->getCacheExtension());
                                   DB::exec('DELETE FROM users WHERE userid = '.$uye->userid.'');
                                   $result++;
                                }
                            }
                           
                            if ( $result == 0 )
                            {
                                $json['message'] = "Şifresi değiştirilmiş hesap bulunamadı.";
                            } else {
                                $json['message'] = "{$result} Adet hesap silindi";
                            }
							
							echo json_encode($json);

                        

?>