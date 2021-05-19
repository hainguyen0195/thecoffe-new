<div class="bl-info-account">
	<div class="bl-avatar text-center">
		<div class="image-upload">
			<label for="file-input" class="icon-camera">
				<img src="<?=($row_detail['avatar'] ? UPLOAD_PHOTO_L.$row_detail['avatar']:'assets/member/avatar.png')?>"/>
				<span class="span-camera"></span>
			</label>
			<input id="file-input" name="avatar" type="file"/>
		</div>
	</div> 
	<p class="p-name"> <b><?=$row_detail['ten']?></b><!-- (Chủ nhà) --></p>
	<p class="p-member">Thành viên từ <?=date("d/m/Y",$row_detail['ngaytao'])?></p>
	<!-- <p class="btn-line btn-orange p-status-user">Môi giới chính thức</p>
	<a href="/moi-gioi" id="register-contact" class="register-contact">Đăng ký hợp tác</a>  -->
</div>
<ul class="nav nav-info" role="tablist">
	<li role="presentation" class="li-1"> <a href="account/tai-khoan"> Thông tin cá nhân </a> </li>
	<li role="presentation" class="li-3"> <a href="account/dang-tin"> Đăng tin BĐS </a> </li>
	<li role="presentation" class="li-3"> <a href="account/tin-dang"> BĐS của tôi </a> </li>
	<li role="presentation" class="li-3"> <a href="account/don-hang"> Đơn hàng của tôi </a> </li>
   	<li role="presentation active" class="li-5"> <a href="javascript:void(0)" onclick="$('#popup-user-change-pass').modal('show');"> Đổi mật khẩu </a> </li>
   	<li role="presentation" class="li-6"> <a href="account/dang-xuat">Đăng xuất</a> </li>
   </ul>