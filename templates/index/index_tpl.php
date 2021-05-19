<div class="main-body">
	<div class="container">
		<div class="about_index flex_row">
			<div class="header flex_row">
				<div class="">
					<?php if(isset($_SESSION[$login_member])){ ?>
						<div class="taikhoandangnhap">
							<div class="name-account"><span>Hi, <?=$_SESSION[$login_member]['ten']?></span></div>
							<ul id="info-account" style="display: none;">
								<li>
									<a href="account/thong-tin"><i class="fas fa-user"></i> Thông tin tài khoản</a>
								</li>
								<?php if(isset($_SESSION[$login_member]['level']) && $_SESSION[$login_member]['level']!=3){ ?>
									<li>
										<a class="fancybox" href="#fancy-dangky"><i class="fas fa-user-edit"></i> Đăng ký</a>
									</li>
								<?php } ?>
								<li>
									<a href="account/dang-xuat"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
								</li>
							</ul>
						</div>
					<?php }else{ ?>
						<a class="fancybox btn-fancybox-dangnhap" href="#fancy-dangnhap">đăng nhập</a>
					<?php } ?>
				</div>
			</div>
			<div class="flex_row row_about">
				<div class="about_left">
					<div class="about_text1">
						Welcome to Website
					</div>
					<div class="about_text2">
						Git Coffe
					</div>
					<div class="about_des">
						Cảm ơn tất cả các bạn đã ghé thăm website của Git Coffe . Các bạn là những thành viên trong đại gia đình Git Coffe , sau thời gian dài làm việc cùng các bạn thì Git Coffe nhận thấy được những sự nỗ lực làm việc , đóng góp phần sức mạnh để Git Coffe ngày càng lớn mạnh , chính vì lẽ đó Git Coffe sẽ tặng các bạn 1 phần quà may mắn . 
					</div>
					<div class="title-form-gift">
						Thử vận may của bạn nào ! 
					</div>
					<div class="form-gift flex_row">
						<input type="text" class="" id="maduthuong" name="maduthuong" required placeholder="Nhập mã dự thưởng" />
						<span class="btn-submit btn-searchgift">Đổi quà</span> 
					</div>
				</div>
				<div class="about_right">
					<div class="hard-vortex">
						<a href="index.php" class="logo_xoay">
							<img onerror="this.src='<?=THUMBS?>/150x150x2/assets/images/noimage.png';" src="<?=THUMBS?>/150x150x2/<?=UPLOAD_PHOTO_L.$logo['photo']?>"/>
						</a>
						<div id="vortex">
							<?php foreach($slidergift as $k=>$v){   ?>
								<div class="square-button">
									<img class="w-100" onerror="this.src='<?=THUMBS?>/180x180x1/assets/images/noimage.png';" src="<?=THUMBS?>/180x180x1/<?=UPLOAD_PHOTO_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>" title="<?=$v['ten'.$lang]?>"/>
									<h4><?=$v['ten'.$lang]?></h4>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="thongbaoquatang" id="fancy-thongbaoquatang" style="max-width: 800px;max-height: 500px;display: none;">
		<div class="boxthongbaoquatang" >
			<div class="thongbaotext"></div>
			<div class="thongbaoimg"></div>
		</div>
	</div>
	<a class="fancy-thongbaoquatang fancybox" href="#fancy-thongbaoquatang"></a>
</div>