<div id="loader-wrapper"><div id="wrap"><div id="loader"></div></div></div>
<?php //if(isset($popup) && $popup['hienthi'] == 1) { ?>
	<!-- Modal popup -->
	<div class="">
		<div id="fancy-dangnhap" style="max-width: 800px;max-height: 500px;display: none;">
			<div class="boxdangnhap flex_row">
				<div class="formdangnhap">
					<div class="title-form">Đăng nhập</div>
					<form method="post" name="dangky" action="account/dang-nhap" enctype="multipart/form-data" autocomplete="off">
						<div class="form-login flex_row">
							<input type="text" id="username" name="username" required placeholder="Nhập username (Số điện thoại / email)" />
							<input type="password" id="password" name="password" required placeholder="Nhập mật khẩu" />
							<input type="submit" class="btn-acount btn-dangnhap" name="dangnhap" value="đăng nhập" >
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php //} ?>

	<div class="">
		<div id="fancy-dangky" style="max-width: 800px;max-height: 500px;display: none;">
			<div class="boxdangnhap flex_row">
				<div class="formdangnhap">
					<div class="title-form">Đăng ký</div>
					<form method="post" name="dangky" action="account/dang-ky" enctype="multipart/form-data" autocomplete="off">
						<div class="form-login flex_row">
							<input type="text" id="ten" name="ten" required placeholder="Nhập họ tên" />
							<input type="text" id="username" name="username" required placeholder="Nhập username (Số điện thoại / email)" />
							<?php if(isset($_SESSION[$login_member]['level']) && $_SESSION[$login_member]['level']==1){ ?>
								<div class="flex_row row_level">
									<div class="title-select">Loại tài khoản</div>
									<select name="level_acc" id="level_acc">
										<option value="2">Quản lý</option>
										<option value="3">Nhân viên</option>
									</select>
								</div>
								<?php if(isset($_SESSION[$login_member]['level']) && $_SESSION[$login_member]['level']==1){ ?>
									<div class="flex_row row_level">
										<div class="title-select">Cửa hàng</div>
										<?php 
										if(count($dscuahang)>0) {  
											echo'<select name="cuahang_acc" id="cuahang_acc">';
											foreach($dscuahang as $k=>$v){ echo'<option value="'.$v['id'].'">'.$v['ten'.$lang].'</option>'; }
											echo'</select>';
										}
										?>
									</div>
								<?php } ?>
							<?php } ?>
							<?php if(isset($_SESSION[$login_member]['level']) && $_SESSION[$login_member]['level']==2){ ?>
								<input type="hidden" name="cuahang_acc" value="<?=$_SESSION[$login_member]['cuahang']?>">
							<?php } ?>
							<input type="password" id="password" name="password" required placeholder="Nhập mật khẩu" />
							<input type="password" id="repassword" name="repassword" required placeholder="Nhập lại mật khẩu" />
							<input type="submit" class="btn-acount btn-ky" name="dangky" value="đăng ký" >
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>