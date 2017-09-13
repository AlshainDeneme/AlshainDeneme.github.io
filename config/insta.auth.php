<?php
include "Constants.php";
include "InstagramException.php";
include "curlHzcoder/Rollrequesthz.php";
include "curlHzcoder/Requesthz.php";
class instaAuth
{
    private $_cookieFolder = "../cookies/";
	
	private $_privateCookie = array();
	
    private $_cookieExtension = ".txt";
	
	  public function _authLogin($username, $password)
    {
      $_cookie = $this->_cookieFolder . $username . $this->_cookieExtension;
	  $this->username = $username;
      $this->password = $password;
      $this->debug = $debug;

      $this->uuid = $this->generateUUID(true);
      $this->device_id = $this->generateDeviceId(md5($username.$password));
	  
        $params = array(
          'device_id'           => $this->device_id,
          'guid'                => $this->uuid,
          'phone_id'            => $this->generateUUID(true),
          'username'            => $this->username,
          'password'            => $this->password,
          'login_attempt_count' => '0'
        );

		
		
        $randomProxy = ( count($this->_proxy) > 0 ) ? $this->_proxy[rand(0, (count($this->_proxy) - 1))] : NULL;

        $fake_ip = $this->fakeIP();
		
		$fake_ip = $this->fakeIP();
        $header = array(
            "Accept: */*",
            "Accept-Language: tr;q=1",
            "HTTP_CLIENT_IP"        => $fake_ip,
            "HTTP_FORWARDED"        => $fake_ip,
            "HTTP_PRAGMA"           => $fake_ip,
            "HTTP_XONNECTION"       => $fake_ip,
            "HTTP_CACHE_INFO"       => $fake_ip,
            "HTTP_XPROXY"           => $fake_ip,
            "HTTP_PROXY_CONNECTION" => $fake_ip,
            "HTTP_VIA"              => $fake_ip,
            "HTTP_X_COMING_FROM"    => $fake_ip,
            "HTTP_COMING_FROM"      => $fake_ip,
            "HTTP_X_FORWARDED_FOR"  => $fake_ip,
            "HTTP_X_FORWARDED"      => $fake_ip,
            "ZHTTP_CACHE_CONTROL"   => $fake_ip,
            "HTTP_CLIENT_IP:" . $fake_ip,
            "HTTP_FORWARDED:" . $fake_ip,
            "HTTP_PRAGMA:" . $fake_ip,
            "HTTP_XONNECTION:" . $fake_ip,
            "HTTP_CACHE_INFO:" . $fake_ip,
            "HTTP_XPROXY:" . $fake_ip,
            "HTTP_PROXY_CONNECTION:" . $fake_ip,
            "HTTP_VIA:" . $fake_ip,
            "HTTP_X_COMING_FROM:" . $fake_ip,
            "HTTP_COMING_FROM:" . $fake_ip,
            "HTTP_X_FORWARDED_FOR:" . $fake_ip,
            "HTTP_X_FORWARDED:" . $fake_ip,
            "ZHTTP_CACHE_CONTROL:" . $fake_ip,
            "REMOTE_ADDR: " . $fake_ip,
            "REMOTE_ADDR"           => $fake_ip,
            "X-Client-IP: " . $fake_ip,
            "Client-IP: " . $fake_ip,
            "HTTP_X_FORWARDED_FOR: " . $fake_ip,
            "X-Forwarded-For: " . $fake_ip,
            "Connection: close",
            "Cache-Control: max-age=0"
        );

		
		
        $curl = curl_init();
        $options = array(
            CURLOPT_URL => 'https://i.instagram.com/api/v1/accounts/login/',
            CURLOPT_COOKIEJAR => $_cookie,
            CURLOPT_COOKIEFILE => $_cookie,
            CURLOPT_USERAGENT => 'Instagram 7.19.0 Android (21/5.0.2; 480dpi; 1080x1776; LGE/Google; Nexus 5; hammerhead; hammerhead; en_US)',
            CURLOPT_HEADER => FALSE,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_FOLLOWLOCATION => FALSE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_VERBOSE => TRUE
        );
        if ( $params )
        {
            $options[CURLOPT_POST] = TRUE;
            $options[CURLOPT_POSTFIELDS] = $this->generateSignature(json_encode($params));
        }
        if ( !empty($randomProxy) )
        {
            $options[CURLOPT_PROXY] = $randomProxy;
            $options[CURLOPT_PROXYTYPE] = 'HTTP';
        }
		

        curl_setopt_array($curl, $options);

        $resp       = curl_exec($curl);

        curl_close($curl);
	
		$fileCookie = file_get_contents($_cookie);
        if ( stripos($fileCookie, 'sessionid') === FALSE )
        {
		   unlink($_cookie);
           throw new Exception('Üzgünüz, şifren yanlıştı. Lütfen şifreni dikkatlice kontrol et.');
        }
			
        return json_decode($resp);
    }
	
	
	
	 public function _doLike($_ID)
    {
        if ( !empty($this->_cookies) )
        {

            $members = array();
            $params = array();
            foreach ( $this->_cookies as $username )
            {
                $_cookie = $this->_cookieFolder . $username . $this->_cookieExtension;
                $randomProxy = ( count($this->_proxy) > 0 ) ? $this->_proxy[rand(0, (count($this->_proxy) - 1))] : NULL;

                if ( !file_exists($_cookie) )
                {
                    continue;
                }
				
				$fileCookie = file_get_contents($_cookie);
                preg_match('/csrftoken.*?instagram.com/si', $fileCookie, $token);
                $token = str_replace(array("i.instagram.com", "csrftoken", "\t", "\n", " "), NULL, $token[0]);
				$fileCookie = file_get_contents($_cookie);
                preg_match('/ds_user_id.*?instagram.com/si', $fileCookie, $auserid);
                $auserid = str_replace(array("i.instagram.com", "#HttpOnly_", "ds_user_id", "\t", "\n", " "), NULL, $auserid[0]);

                $members[] = $username;

                $fake_ip = $this->fakeIP();
                $header = array(
                    "Accept: */*",
                    "Accept-Language: tr;q=1",
                    "HTTP_CLIENT_IP"        => $fake_ip,
                    "HTTP_FORWARDED"        => $fake_ip,
                    "HTTP_PRAGMA"           => $fake_ip,
                    "HTTP_XONNECTION"       => $fake_ip,
                    "HTTP_CACHE_INFO"       => $fake_ip,
                    "HTTP_XPROXY"           => $fake_ip,
                    "HTTP_PROXY_CONNECTION" => $fake_ip,
                    "HTTP_VIA"              => $fake_ip,
                    "HTTP_X_COMING_FROM"    => $fake_ip,
                    "HTTP_COMING_FROM"      => $fake_ip,
                    "HTTP_X_FORWARDED_FOR"  => $fake_ip,
                    "HTTP_X_FORWARDED"      => $fake_ip,
                    "ZHTTP_CACHE_CONTROL"   => $fake_ip,
                    "HTTP_CLIENT_IP:" . $fake_ip,
                    "HTTP_FORWARDED:" . $fake_ip,
                    "HTTP_PRAGMA:" . $fake_ip,
                    "HTTP_XONNECTION:" . $fake_ip,
                    "HTTP_CACHE_INFO:" . $fake_ip,
                    "HTTP_XPROXY:" . $fake_ip,
                    "HTTP_PROXY_CONNECTION:" . $fake_ip,
                    "HTTP_VIA:" . $fake_ip,
                    "HTTP_X_COMING_FROM:" . $fake_ip,
                    "HTTP_COMING_FROM:" . $fake_ip,
                    "HTTP_X_FORWARDED_FOR:" . $fake_ip,
                    "HTTP_X_FORWARDED:" . $fake_ip,
                    "ZHTTP_CACHE_CONTROL:" . $fake_ip,
                    "REMOTE_ADDR: " . $fake_ip,
                    "REMOTE_ADDR"           => $fake_ip,
                    "X-Client-IP: " . $fake_ip,
                    "Client-IP: " . $fake_ip,
                    "HTTP_X_FORWARDED_FOR: " . $fake_ip,
                    "X-Forwarded-For: " . $fake_ip,
                    "Connection: close",
                    "Cache-Control: max-age=0"
                );
				$this->uuid = $this->generateUUID(true);
				$data = json_encode([
				'_uuid'      => $this->uuid,
				'_uid'       => $auserid,
				'user_id'    => $_ID,
				'_csrftoken' => $token
				]);
				
				$post = $this->generateSignature($data);
				
                $options = array(
                    CURLOPT_POST => TRUE,
                    CURLOPT_POSTFIELDS => $post,
                    CURLOPT_HTTPHEADER => $header,
                    CURLOPT_COOKIEJAR => $_cookie,
                    CURLOPT_COOKIEFILE => $_cookie,
                    CURLOPT_USERAGENT => Constants::USER_AGENT,
                );

                if ( !empty($randomProxy) )
                {
                    $options[CURLOPT_PROXY] = $randomProxy;
                    $options[CURLOPT_PROXYTYPE] = 'HTTP';
                }

                $params[] = array(
                    'url' => "https://i.instagram.com/api/v1/media/{$_ID}/like/",
                    'options' => $options
                );
            }
        } else {
            throw new Exception('Beğeni yaptırabilmeniz için Kullanıcı ve token tanımlamalısınız.');
        }

        $multiCURL = new \RollingCurl\RollingCurl();
        foreach ($params as $param) {
            $request = new \RollingCurl\Request($param['url'], 'POST');
            $request->setOptions($param['options']);
            $multiCURL->add($request);
        }

        $this->_result = 0;
        $multiCURL
            ->setCallback(function(\RollingCurl\Request $request, \RollingCurl\RollingCurl $rollingCurl) {

                $result = $request->getResponseText();
                if ( is_string($result) )
                {
                    $result = json_decode($result);
                    if ( is_object($result) )
                    {
                        if ($result->status == 'ok') $this->_result++;
                    }
                }
            })
            ->setSimultaneousLimit(100)
            ->execute()
        ;

        $result = array(
            'success' => $this->_result,
            'errors' => NULL
        );
        return json_decode(json_encode($result));
    }
	
	
	
	
	
	
	
	
	
	
	
	
	public function _doFollow($_ID, $DELETE = NULL)
    {
        if ( !empty($this->_cookies) )
        {
			$type = ($DELETE == TRUE) ? 'destroy' : 'create';
            $members = array();
            $params = array();
            foreach ( $this->_cookies as $username )
            {
                $_cookie = $this->_cookieFolder . $username . $this->_cookieExtension;
                $randomProxy = ( count($this->_proxy) > 0 ) ? $this->_proxy[rand(0, (count($this->_proxy) - 1))] : NULL;

                if ( !file_exists($_cookie) )
                {
                    continue;
                }
				
				$fileCookie = file_get_contents($_cookie);
                preg_match('/csrftoken.*?instagram.com/si', $fileCookie, $token);
                $token = str_replace(array("i.instagram.com", "csrftoken", "\t", "\n", " "), NULL, $token[0]);
				$fileCookie = file_get_contents($_cookie);
                preg_match('/ds_user_id.*?instagram.com/si', $fileCookie, $auserid);
                $auserid = str_replace(array("i.instagram.com", "#HttpOnly_", "ds_user_id", "\t", "\n", " "), NULL, $auserid[0]);

                $members[] = $username;

                $fake_ip = $this->fakeIP();
                $header = array(
                    "Accept: */*",
                    "Accept-Language: tr;q=1",
                    "HTTP_CLIENT_IP"        => $fake_ip,
                    "HTTP_FORWARDED"        => $fake_ip,
                    "HTTP_PRAGMA"           => $fake_ip,
                    "HTTP_XONNECTION"       => $fake_ip,
                    "HTTP_CACHE_INFO"       => $fake_ip,
                    "HTTP_XPROXY"           => $fake_ip,
                    "HTTP_PROXY_CONNECTION" => $fake_ip,
                    "HTTP_VIA"              => $fake_ip,
                    "HTTP_X_COMING_FROM"    => $fake_ip,
                    "HTTP_COMING_FROM"      => $fake_ip,
                    "HTTP_X_FORWARDED_FOR"  => $fake_ip,
                    "HTTP_X_FORWARDED"      => $fake_ip,
                    "ZHTTP_CACHE_CONTROL"   => $fake_ip,
                    "HTTP_CLIENT_IP:" . $fake_ip,
                    "HTTP_FORWARDED:" . $fake_ip,
                    "HTTP_PRAGMA:" . $fake_ip,
                    "HTTP_XONNECTION:" . $fake_ip,
                    "HTTP_CACHE_INFO:" . $fake_ip,
                    "HTTP_XPROXY:" . $fake_ip,
                    "HTTP_PROXY_CONNECTION:" . $fake_ip,
                    "HTTP_VIA:" . $fake_ip,
                    "HTTP_X_COMING_FROM:" . $fake_ip,
                    "HTTP_COMING_FROM:" . $fake_ip,
                    "HTTP_X_FORWARDED_FOR:" . $fake_ip,
                    "HTTP_X_FORWARDED:" . $fake_ip,
                    "ZHTTP_CACHE_CONTROL:" . $fake_ip,
                    "REMOTE_ADDR: " . $fake_ip,
                    "REMOTE_ADDR"           => $fake_ip,
                    "X-Client-IP: " . $fake_ip,
                    "Client-IP: " . $fake_ip,
                    "HTTP_X_FORWARDED_FOR: " . $fake_ip,
                    "X-Forwarded-For: " . $fake_ip,
                    "Connection: close",
                    "Cache-Control: max-age=0"
                );
				$this->uuid = $this->generateUUID(true);
				$data = json_encode([
				'_uuid'      => $this->uuid,
				'_uid'       => $auserid,
				'user_id'    => $_ID,
				'_csrftoken' => $token
				]);
				
				$post = $this->generateSignature($data);
				
                $options = array(
                    CURLOPT_POST => TRUE,
                    CURLOPT_POSTFIELDS => $post,
                    CURLOPT_HTTPHEADER => $header,
                    CURLOPT_COOKIEJAR => $_cookie,
                    CURLOPT_COOKIEFILE => $_cookie,
                    CURLOPT_USERAGENT => Constants::USER_AGENT,
                );

                if ( !empty($randomProxy) )
                {
                    $options[CURLOPT_PROXY] = $randomProxy;
                    $options[CURLOPT_PROXYTYPE] = 'HTTP';
                }

                $params[] = array(
                    'url' => "https://i.instagram.com/api/v1/friendships/{$type}/{$_ID}/",
                    'options' => $options
                );
            }
        } else {
            throw new Exception('follow, unfollow yaptırabilmeniz için Kullanıcı ve token tanımlamalısınız.');
        }

        $multiCURL = new \RollingCurl\RollingCurl();
        foreach ($params as $param) {
            $request = new \RollingCurl\Request($param['url'], 'POST');
            $request->setOptions($param['options']);
            $multiCURL->add($request);
        }

        $this->_result = 0;
        $multiCURL
            ->setCallback(function(\RollingCurl\Request $request, \RollingCurl\RollingCurl $rollingCurl) {

                $result = $request->getResponseText();
                if ( is_string($result) )
                {
                    $result = json_decode($result);
                    if ( is_object($result) )
                    {
                        if ($result->status == 'ok') $this->_result++;
                    }
                }
            })
            ->setSimultaneousLimit(100)
            ->execute()
        ;

        $result = array(
            'success' => $this->_result,
            'errors' => NULL
        );
        return json_decode(json_encode($result));
    }
	
	
	
	
	
	
	

	
	public function _doComment($_ID, $comments)
    {
        if ( !empty($this->_cookies) )
        {
			$toplamComment = count($comments);
            $members = array();
            $params = array();
            foreach ( $this->_cookies as $username )
            {
				$randomComment = $comments[rand(0, $toplamComment-1)];
                $_cookie = $this->_cookieFolder . $username . $this->_cookieExtension;
                $randomProxy = ( count($this->_proxy) > 0 ) ? $this->_proxy[rand(0, (count($this->_proxy) - 1))] : NULL;

                if ( !file_exists($_cookie) )
                {
                    continue;
                }
				
				$fileCookie = file_get_contents($_cookie);
                preg_match('/csrftoken.*?instagram.com/si', $fileCookie, $token);
                $token = str_replace(array("i.instagram.com", "csrftoken", "\t", "\n", " "), NULL, $token[0]);
				$fileCookie = file_get_contents($_cookie);
                preg_match('/ds_user_id.*?instagram.com/si', $fileCookie, $auserid);
                $auserid = str_replace(array("i.instagram.com", "#HttpOnly_", "ds_user_id", "\t", "\n", " "), NULL, $auserid[0]);

                $members[] = $username;

                $fake_ip = $this->fakeIP();
                $header = array(
                    "Accept: */*",
                    "Accept-Language: tr;q=1",
                    "HTTP_CLIENT_IP"        => $fake_ip,
                    "HTTP_FORWARDED"        => $fake_ip,
                    "HTTP_PRAGMA"           => $fake_ip,
                    "HTTP_XONNECTION"       => $fake_ip,
                    "HTTP_CACHE_INFO"       => $fake_ip,
                    "HTTP_XPROXY"           => $fake_ip,
                    "HTTP_PROXY_CONNECTION" => $fake_ip,
                    "HTTP_VIA"              => $fake_ip,
                    "HTTP_X_COMING_FROM"    => $fake_ip,
                    "HTTP_COMING_FROM"      => $fake_ip,
                    "HTTP_X_FORWARDED_FOR"  => $fake_ip,
                    "HTTP_X_FORWARDED"      => $fake_ip,
                    "ZHTTP_CACHE_CONTROL"   => $fake_ip,
                    "HTTP_CLIENT_IP:" . $fake_ip,
                    "HTTP_FORWARDED:" . $fake_ip,
                    "HTTP_PRAGMA:" . $fake_ip,
                    "HTTP_XONNECTION:" . $fake_ip,
                    "HTTP_CACHE_INFO:" . $fake_ip,
                    "HTTP_XPROXY:" . $fake_ip,
                    "HTTP_PROXY_CONNECTION:" . $fake_ip,
                    "HTTP_VIA:" . $fake_ip,
                    "HTTP_X_COMING_FROM:" . $fake_ip,
                    "HTTP_COMING_FROM:" . $fake_ip,
                    "HTTP_X_FORWARDED_FOR:" . $fake_ip,
                    "HTTP_X_FORWARDED:" . $fake_ip,
                    "ZHTTP_CACHE_CONTROL:" . $fake_ip,
                    "REMOTE_ADDR: " . $fake_ip,
                    "REMOTE_ADDR"           => $fake_ip,
                    "X-Client-IP: " . $fake_ip,
                    "Client-IP: " . $fake_ip,
                    "HTTP_X_FORWARDED_FOR: " . $fake_ip,
                    "X-Forwarded-For: " . $fake_ip,
                    "Connection: close",
                    "Cache-Control: max-age=0"
                );
				$this->uuid = $this->generateUUID(true);
				$data = json_encode([
				'_uuid'      => $this->uuid,
				'_uid'       => $auserid,
				'_csrftoken' => $token,
				'comment_text'   => $randomComment
				]);
				
				$post = $this->generateSignature($data);
				
                $options = array(
                    CURLOPT_POST => TRUE,
                    CURLOPT_POSTFIELDS => $post,
                    CURLOPT_HTTPHEADER => $header,
                    CURLOPT_COOKIEJAR => $_cookie,
                    CURLOPT_COOKIEFILE => $_cookie,
                    CURLOPT_USERAGENT => Constants::USER_AGENT,
                );

                if ( !empty($randomProxy) )
                {
                    $options[CURLOPT_PROXY] = $randomProxy;
                    $options[CURLOPT_PROXYTYPE] = 'HTTP';
                }

                $params[] = array(
                    'url' => "https://i.instagram.com/api/v1/media/{$_ID}/comment/",
                    'options' => $options
                );
            }
        } else {
            throw new Exception('Yorum yaptırabilmeniz için kullanıcı ve token tanımlamalısınız.');
        }

        $multiCURL = new \RollingCurl\RollingCurl();
        foreach ($params as $param) {
            $request = new \RollingCurl\Request($param['url'], 'POST');
            $request->setOptions($param['options']);
            $multiCURL->add($request);
        }

        $this->_result = 0;
        $multiCURL
            ->setCallback(function(\RollingCurl\Request $request, \RollingCurl\RollingCurl $rollingCurl) {

                $result = $request->getResponseText();
                if ( is_string($result) )
                {
                    $result = json_decode($result);
                    if ( is_object($result) )
                    {
                        if ($result->status == 'ok') $this->_result++;
                    }
                }
            })
            ->setSimultaneousLimit(100)
            ->execute()
        ;

        $result = array(
            'success' => $this->_result,
            'errors' => NULL
        );
        return json_decode(json_encode($result));
    }
	
	
	public function followed($ID, $username, $count = NULL)
    {
        $_cookie = 'cookies/'.$username.'.txt';
        if ( file_exists($_cookie) )
        {
            $fake_ip = $this->fakeIP();
            $header = array(
                "Accept: */*",
                "Accept-Language: tr;q=1",
                "HTTP_CLIENT_IP"        => $fake_ip,
                "HTTP_FORWARDED"        => $fake_ip,
                "HTTP_PRAGMA"           => $fake_ip,
                "HTTP_XONNECTION"       => $fake_ip,
                "HTTP_CACHE_INFO"       => $fake_ip,
                "HTTP_XPROXY"           => $fake_ip,
                "HTTP_PROXY_CONNECTION" => $fake_ip,
                "HTTP_VIA"              => $fake_ip,
                "HTTP_X_COMING_FROM"    => $fake_ip,
                "HTTP_COMING_FROM"      => $fake_ip,
                "HTTP_X_FORWARDED_FOR"  => $fake_ip,
                "HTTP_X_FORWARDED"      => $fake_ip,
                "ZHTTP_CACHE_CONTROL"   => $fake_ip,
                "HTTP_CLIENT_IP:" . $fake_ip,
                "HTTP_FORWARDED:" . $fake_ip,
                "HTTP_PRAGMA:" . $fake_ip,
                "HTTP_XONNECTION:" . $fake_ip,
                "HTTP_CACHE_INFO:" . $fake_ip,
                "HTTP_XPROXY:" . $fake_ip,
                "HTTP_PROXY_CONNECTION:" . $fake_ip,
                "HTTP_VIA:" . $fake_ip,
                "HTTP_X_COMING_FROM:" . $fake_ip,
                "HTTP_COMING_FROM:" . $fake_ip,
                "HTTP_X_FORWARDED_FOR:" . $fake_ip,
                "HTTP_X_FORWARDED:" . $fake_ip,
                "ZHTTP_CACHE_CONTROL:" . $fake_ip,
                "REMOTE_ADDR: " . $fake_ip,
                "REMOTE_ADDR"           => $fake_ip,
                "X-Client-IP: " . $fake_ip,
                "Client-IP: " . $fake_ip,
                "HTTP_X_FORWARDED_FOR: " . $fake_ip,
                "X-Forwarded-For: " . $fake_ip
            );
            $header[] = "User-Agent: ".Constants::USER_AGENT."";
            $header[] = 'Connection: close';
            $header[] = 'Cache-Control: max-age=0';

            $options = array(
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_COOKIEJAR => $_cookie,
                CURLOPT_COOKIEFILE => $_cookie
            );

            $count = ($count) ? $count : 1;
            $max_id = NULL;
            $followerLists = array();
            while ( count($followerLists) < $count )
            {
                if ( $max_id )
                {
                    $param = array(
                        'url' => "http://i.instagram.com/api/v1/friendships/{$ID}/following/?max_id={$max_id}",
                        'options' => $options
                    );

                } else {

                    $param = array(
                        'url' => "http://i.instagram.com/api/v1/friendships/{$ID}/following/",
                        'options' => $options
                    );
                }

                $followers = $this->curl($param);
                foreach ($followers->users as $user) {
                    $followerLists[] = $user;
                }
                $max_id = $followers->next_max_id;
                if ( !$followers->next_max_id ) break;
            }


        } else {

            throw new Exception('Error : followed Özel Cookie Tanımsız');
        }

        return json_encode($followerLists);
    }
	
	
	
	public function followers($ID, $username, $count = NULL)
    {
        $_cookie = 'cookies/'.$username.'.txt';
        if ( file_exists($_cookie) )
        {
            $fake_ip = $this->fakeIP();
            $header = array(
                "Accept: */*",
                "Accept-Language: tr;q=1",
                "HTTP_CLIENT_IP"        => $fake_ip,
                "HTTP_FORWARDED"        => $fake_ip,
                "HTTP_PRAGMA"           => $fake_ip,
                "HTTP_XONNECTION"       => $fake_ip,
                "HTTP_CACHE_INFO"       => $fake_ip,
                "HTTP_XPROXY"           => $fake_ip,
                "HTTP_PROXY_CONNECTION" => $fake_ip,
                "HTTP_VIA"              => $fake_ip,
                "HTTP_X_COMING_FROM"    => $fake_ip,
                "HTTP_COMING_FROM"      => $fake_ip,
                "HTTP_X_FORWARDED_FOR"  => $fake_ip,
                "HTTP_X_FORWARDED"      => $fake_ip,
                "ZHTTP_CACHE_CONTROL"   => $fake_ip,
                "HTTP_CLIENT_IP:" . $fake_ip,
                "HTTP_FORWARDED:" . $fake_ip,
                "HTTP_PRAGMA:" . $fake_ip,
                "HTTP_XONNECTION:" . $fake_ip,
                "HTTP_CACHE_INFO:" . $fake_ip,
                "HTTP_XPROXY:" . $fake_ip,
                "HTTP_PROXY_CONNECTION:" . $fake_ip,
                "HTTP_VIA:" . $fake_ip,
                "HTTP_X_COMING_FROM:" . $fake_ip,
                "HTTP_COMING_FROM:" . $fake_ip,
                "HTTP_X_FORWARDED_FOR:" . $fake_ip,
                "HTTP_X_FORWARDED:" . $fake_ip,
                "ZHTTP_CACHE_CONTROL:" . $fake_ip,
                "REMOTE_ADDR: " . $fake_ip,
                "REMOTE_ADDR"           => $fake_ip,
                "X-Client-IP: " . $fake_ip,
                "Client-IP: " . $fake_ip,
                "HTTP_X_FORWARDED_FOR: " . $fake_ip,
                "X-Forwarded-For: " . $fake_ip
            );
            $header[] = "User-Agent: ".Constants::USER_AGENT."";
            $header[] = 'Connection: close';
            $header[] = 'Cache-Control: max-age=0';

            $options = array(
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_COOKIEJAR => $_cookie,
                CURLOPT_COOKIEFILE => $_cookie
            );

            $count = ($count) ? $count : 1;
            $max_id = NULL;
            $followerLists = array();
            while ( count($followerLists) < $count )
            {
                if ( $max_id )
                {
                    $param = array(
                        'url' => "http://i.instagram.com/api/v1/friendships/{$ID}/followers/?max_id={$max_id}",
                        'options' => $options
                    );

                } else {

                    $param = array(
                        'url' => "http://i.instagram.com/api/v1/friendships/{$ID}/followers/",
                        'options' => $options
                    );
                }

                $followers = $this->curl($param);
                foreach ($followers->users as $user) {
                    $followerLists[] = $user;
                }
                $max_id = $followers->next_max_id;
                if ( !$followers->next_max_id ) break;
            }


        } else {

            throw new Exception('Error : followed Özel Cookie Tanımsız');
        }

        return json_encode($followerLists);
    }

	
	
		public function getMedia($username)
    {
        $_cookie = 'cookies/'.$username.'.txt';
        if ( file_exists($_cookie) )
        {
            $fake_ip = $this->fakeIP();
            $header = array(
                "Accept: */*",
                "Accept-Language: tr;q=1",
                "HTTP_CLIENT_IP"        => $fake_ip,
                "HTTP_FORWARDED"        => $fake_ip,
                "HTTP_PRAGMA"           => $fake_ip,
                "HTTP_XONNECTION"       => $fake_ip,
                "HTTP_CACHE_INFO"       => $fake_ip,
                "HTTP_XPROXY"           => $fake_ip,
                "HTTP_PROXY_CONNECTION" => $fake_ip,
                "HTTP_VIA"              => $fake_ip,
                "HTTP_X_COMING_FROM"    => $fake_ip,
                "HTTP_COMING_FROM"      => $fake_ip,
                "HTTP_X_FORWARDED_FOR"  => $fake_ip,
                "HTTP_X_FORWARDED"      => $fake_ip,
                "ZHTTP_CACHE_CONTROL"   => $fake_ip,
                "HTTP_CLIENT_IP:" . $fake_ip,
                "HTTP_FORWARDED:" . $fake_ip,
                "HTTP_PRAGMA:" . $fake_ip,
                "HTTP_XONNECTION:" . $fake_ip,
                "HTTP_CACHE_INFO:" . $fake_ip,
                "HTTP_XPROXY:" . $fake_ip,
                "HTTP_PROXY_CONNECTION:" . $fake_ip,
                "HTTP_VIA:" . $fake_ip,
                "HTTP_X_COMING_FROM:" . $fake_ip,
                "HTTP_COMING_FROM:" . $fake_ip,
                "HTTP_X_FORWARDED_FOR:" . $fake_ip,
                "HTTP_X_FORWARDED:" . $fake_ip,
                "ZHTTP_CACHE_CONTROL:" . $fake_ip,
                "REMOTE_ADDR: " . $fake_ip,
                "REMOTE_ADDR"           => $fake_ip,
                "X-Client-IP: " . $fake_ip,
                "Client-IP: " . $fake_ip,
                "HTTP_X_FORWARDED_FOR: " . $fake_ip,
                "X-Forwarded-For: " . $fake_ip
            );
            $header[] = "User-Agent: ".Constants::USER_AGENT."";
            $header[] = 'Connection: close';
            $header[] = 'Cache-Control: max-age=0';

            $options = array(
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_COOKIEJAR => $_cookie,
                CURLOPT_COOKIEFILE => $_cookie
            );

      

                    $param = array(
                        'url' => "https://www.instagram.com/".$username."/media/",
                        'options' => $options
                    );
              

                $media = $this->curl($param);
                
         


        } else {

            throw new Exception('Error : media Özel Cookie Tanımsız');
        }

        return json_encode($media);
    }
	

	
	
	    protected function curl($params)
    {
        $ch = curl_init();

        $options = array(
            CURLOPT_URL => $params['url'],
            CURLOPT_HEADER => FALSE,
            CURLOPT_USERAGENT => Constants::USER_AGENT,
            CURLOPT_FOLLOWLOCATION => FALSE,
            CURLOPT_RETURNTRANSFER => TRUE
        );
        if ( is_array($params['options']) )
        {
            foreach($params['options'] as $option => $value) {
                $options[$option] = $value;
            }
        }
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }
	
	
	public function _cURL($link){
		
		$c = curl_init();
	
	curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 0);
	curl_setopt($c, CURLOPT_TIMEOUT, 0);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($c, CURLOPT_URL, $link);
	
	$contents = curl_exec($c);
	
	$err  = curl_getinfo($c,CURLINFO_HTTP_CODE);
	curl_close($c);
	
	if ($contents) return $contents;
		else return FALSE;
		
	}
	

	
	    public function setPrivateCookie($cookies)
    {
        $this->_privateCookie = $cookies;
    }
	
	
	public function setCacheFolder($folder)
    {
        $this->_cookieFolder = $folder;
        return true;
    }
	
	public function setProxy($proxy)
    {
        $this->_proxy = $proxy;
    }
	
	public function setCookies($cookies)
    {
        $this->_cookies = $cookies;
    }
	
	public function setCacheExtension($extension)
    {
        $this->_cookieExtension = $extension;
        return true;
    }
	
	public function curl_get_file_contents($URL) {

	$c = curl_init();
	
	curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 0);
	curl_setopt($c, CURLOPT_TIMEOUT, 0);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($c, CURLOPT_URL, $URL);
	
	$contents = curl_exec($c);
	
	$err  = curl_getinfo($c,CURLINFO_HTTP_CODE);
	curl_close($c);
	
	if ($contents) return $contents;
		else return FALSE;

	}
	
	public function getCacheFolder()
    {
        return $this->_cookieFolder;
    }
	
	public function getCacheExtension()
    {
        return $this->_cookieExtension;
    }
	
    public function generateSignature($data){
    $hash = hash_hmac('sha256', $data, Constants::IG_SIG_KEY);
    return 'ig_sig_key_version='.Constants::SIG_KEY_VERSION.'&signed_body='.$hash.'.'.urlencode($data);
	}
	
    public function generateDeviceId($seed)
    {
    $volatile_seed = filemtime(__DIR__);
    return 'android-'.substr(md5($seed.$volatile_seed), 16);
    }

    public function generateUUID($type)
    {
        $uuid = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
      mt_rand(0, 0xffff), mt_rand(0, 0xffff),
      mt_rand(0, 0xffff),
      mt_rand(0, 0x0fff) | 0x4000,
      mt_rand(0, 0x3fff) | 0x8000,
      mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );

        return $type ? $uuid : str_replace('-', '', $uuid);
    }
	
	protected function fakeIP()
    {
        return "85.103." . rand(1, 255) . "." . rand(1, 255);
        //return long2ip(mt_rand(0, 65537) * mt_rand(0, 65535));
    }
}