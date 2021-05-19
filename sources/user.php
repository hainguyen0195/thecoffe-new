<?php
	if(!defined('SOURCES')) die("Error");

	$action = htmlspecialchars($match['params']['action']);

	switch($action)
	{
		case 'dang-nhap':
			$title_crumb = dangnhap;
			$template = "";
			if(isset($_SESSION[$login_member]['active']) && $_SESSION[$login_member]['active'] == true) $func->transfer("Trang không tồn tại",$config_base, false);
			if(isset($_POST['dangnhap'])) login();
			break;

		case 'dang-ky':
			$title_crumb = dangky;
			$template = "";
			if(isset($_POST['dangky'])) signup();
			break;

		case 'thong-tin':
			if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) $func->transfer("Trang không tồn tại",$config_base, false);
			$template = "account/thongtin";
			$title_crumb = capnhatthongtin;
			info_user();
			break;

		case 'dang-xuat':
			if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) $func->transfer("Trang không tồn tại",$config_base, false);
			logout();
		
		default:
			header('HTTP/1.0 404 Not Found', true, 404);
			include("404.php");
			exit();
	}

	/* SEO */
	$seo->setSeo('title',$title_crumb);

	/* breadCrumbs */
	if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs('',$title_crumb);
	$breadcrumbs = $breadcr->getBreadCrumbs();

	function info_user()
	{
		global $d, $func, $row_detail, $config_base, $login_member;

		$iduser = $_SESSION[$login_member]['id'];

		if($iduser)
		{
			$row_detail = $d->rawQueryOne("select ten, username, gioitinh, ngaysinh, email, dienthoai, diachi,cuahang,level,id,diemthuong from #_member where id = ? limit 0,1",array($iduser));

		    if(isset($_POST['capnhatthongtin']))
		    {
		    	$password = (isset($_POST['password'])) ? htmlspecialchars($_POST['password']) : '';
		    	$passwordMD5 = md5($password);
	            $new_password = (isset($_POST['new-password'])) ? htmlspecialchars($_POST['new-password']) : '';
	            $new_passwordMD5 = md5($new_password);
	            $new_password_confirm = (isset($_POST['new-password-confirm'])) ? htmlspecialchars($_POST['new-password-confirm']) : '';

		        if($password)
		        {
		            $row = $d->rawQueryOne("select id from #_member where id = ? and password = ? limit 0,1",array($iduser,$passwordMD5));

		            if(!$row['id']) $func->transfer("Mật khẩu cũ không chính xác","", false);
		            if(!$new_password || ($new_password != $new_password_confirm)) $func->transfer("Thông tin mật khẩu mới không chính xác","", false);

		            $data['password'] = $new_passwordMD5;
		        }

		        $data['ten'] = (isset($_POST['ten'])) ? htmlspecialchars($_POST['ten']) : '';
		        $data['diachi'] = (isset($_POST['diachi'])) ? htmlspecialchars($_POST['diachi']) : '';
		        $data['dienthoai'] = (isset($_POST['dienthoai'])) ? htmlspecialchars($_POST['dienthoai']) : 0;
		        $data['email'] = (isset($_POST['email'])) ? htmlspecialchars($_POST['email']) : '';
		        $data['ngaysinh'] = (isset($_POST['ngaysinh'])) ? strtotime(str_replace("/","-",htmlspecialchars($_POST['ngaysinh']))) : 0;
		        $data['gioitinh'] = (isset($_POST['gioitinh'])) ? htmlspecialchars($_POST['gioitinh']) : 0;

		        $d->where('id', $iduser);
		        if($d->update('member',$data))
		        {
		        	if($password)
		        	{
			            unset($_SESSION[$login_member]);
			            setcookie('login_member_id',"",-1,'/');
						setcookie('login_member_session',"",-1,'/');
		            	$func->transfer("Cập nhật thông tin thành công",$config_base);
		        	}
		        	$func->transfer("Cập nhật thông tin thành công",$config_base."account/thong-tin");	            
		        }
		    }
		}
		else
		{
			$func->transfer("Trang không tồn tại",$config_base, false);
		}
	}


	function login()
	{
		global $d, $func, $login_member, $config_base;
		$username = (isset($_POST['username'])) ? htmlspecialchars($_POST['username']) : '';
		$password = (isset($_POST['password'])) ? htmlspecialchars($_POST['password']) : '';
		$passwordMD5 = md5($password);
		$remember = (isset($_POST['remember-user'])) ? htmlspecialchars($_POST['remember-user']) : false;

		$row = $d->rawQueryOne("select id, password, username,level, ten,cuahang from #_member where username = ? and hienthi > 0 limit 0,1",array($username));

		if($row['id'])
		{
			if($row['password'] == $passwordMD5)
			{
				/* Tạo login session */
				$id_user = $row['id'];
				$lastlogin = time();
				$login_session = md5($row['password'].$lastlogin);
				$d->rawQuery("update #_member set login_session = ?, lastlogin = ? where id = ?",array($login_session,$lastlogin,$id_user));

				/* Lưu session login */
				$_SESSION[$login_member]['active'] = true;
				$_SESSION[$login_member]['id'] = $row['id'];
				$_SESSION[$login_member]['username'] = $row['username'];
				$_SESSION[$login_member]['ten'] = $row['ten'];
				$_SESSION[$login_member]['level'] = $row['level'];
				$_SESSION[$login_member]['cuahang'] = $row['cuahang'];
				$_SESSION[$login_member]['login_session'] = $login_session;

				/* Nhớ mật khẩu */
				setcookie('login_member_id',"",-1,'/');
				setcookie('login_member_session',"",-1,'/');
				if($remember)
				{
					$time_expiry = time()+3600*24;
					setcookie('login_member_id',$row['id'],$time_expiry,'/');
					setcookie('login_member_session',$login_session,$time_expiry,'/');
				}

				$func->transfer("Đăng nhập thành công", $config_base);
			}
			else
			{
				$func->transfer("Tên đăng nhập hoặc mật khẩu không chính xác. Hoặc tài khoản của bạn chưa được xác nhận từ Quản trị website", $config_base, false);
			}
		}
		else
		{
			$func->transfer("Tên đăng nhập hoặc mật khẩu không chính xác. Hoặc tài khoản của bạn chưa được xác nhận từ Quản trị website", $config_base, false);
		}
	}

	function signup()
	{
		global $d, $func, $config_base;

		$username = (isset($_POST['username'])) ? htmlspecialchars($_POST['username']) : '';
		$password = (isset($_POST['password'])) ? htmlspecialchars($_POST['password']) : '';
		$passwordMD5 = md5($password);
		$repassword = (isset($_POST['repassword'])) ? htmlspecialchars($_POST['repassword']) : '';
		$email = (isset($_POST['email'])) ? htmlspecialchars($_POST['email']) : '';
		$maxacnhan = $func->digitalRandom(0,3,6);

		if($password != $repassword) $func->transfer("Xác nhận mật khẩu không trùng khớp", $config_base."account/dang-ky", false);

		/* Kiểm tra tên đăng ký */
		$row = $d->rawQueryOne("select id from #_member where username = ? limit 0,1",array($username));
		if($row['id']) $func->transfer("Tên đăng nhập đã tồn tại", $config_base, false);

		$data['ten'] = (isset($_POST['ten'])) ? htmlspecialchars($_POST['ten']) : '';
		$data['level'] = (isset($_POST['level_acc'])) ? htmlspecialchars($_POST['level_acc']) : '';
		$data['cuahang'] = (isset($_POST['cuahang_acc'])) ? htmlspecialchars($_POST['cuahang_acc']) : '';
		$data['username'] = $username;
		$data['password'] = md5($password);
		$data['hienthi'] = 1;
		
		if($d->insert('member',$data))
		{
			$func->transfer("Đăng ký thành viên thành công. ", $config_base);
		}
		else
		{
			$func->transfer("Đăng ký thành viên thất bại. Vui lòng thử lại sau.", $config_base, false);
		}
	}

	function logout()
	{
		global $d, $func, $login_member, $config_base;

		unset($_SESSION[$login_member]);
		setcookie('login_member_id',"",-1,'/');
		setcookie('login_member_session',"",-1,'/');

		$func->redirect($config_base);
	}
?>