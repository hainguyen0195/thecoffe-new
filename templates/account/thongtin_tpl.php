<div class="main-body2">
   <div class="container">
      <div class="about_index flex_row">
         <div class="header flex_row">
            <div class="">
               <div class="taikhoandangnhap flex_row">
                  <div class="home">
                     <a href="index">Trang chủ</a>
                  </div>
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
            </div>
         </div>
         <div class="formthongtin">
            <div class="title-form">Thông tin tài khoản</div>
            <form method="post" name="dangky" action="account/thong-tin" enctype="multipart/form-data" autocomplete="off">
               <div class="form-login flex_row">
                  <input type="text" id="ten" name="ten" required placeholder="Nhập họ tên" value="<?=$row_detail['ten']?>" />
                  <input type="text" id="username" name="username" required placeholder="Nhập username (Số điện thoại / email)" value="<?=$row_detail['username']?>" />
                  <div class="flex_row row_level">
                     <div class="title-select">Loại tài khoản</div>
                     <div class="info-sl">
                        <?php if($row_detail['level']==1){
                          echo'Tài khoản tổng';
                       }if ($row_detail['level']==2) {
                        echo'Tài khoản trưởng cửa hàng';
                     } else {
                       echo'Tài khoản nhân viên';
                    }
                    ?>
                 </div>
              </div>
              <div class="flex_row row_level">
               <div class="title-select">Cửa hàng</div>
               <div class="info-sl">
                  <?php 
                  if($row_detail['cuahang']==0){
                     echo'Tổng công ty';
                  }else{
                     $dscuahang = $d->rawQueryOne("select tenvi,  id from #_news where id = ? and  type = ? and hienthi > 0 order by stt,id asc",array($row_detail['cuahang'],'cua-hang'));
                     echo $dscuahang['tenvi'];
                  }
                  ?>
               </div>
            </div>

            <?php if(isset($row_detail['level']) && $row_detail['level']==3){ ?>
               <input type="text" name="diemthuong" value="<?=$row_detail['diemthuong']?>" readonly>

               <div class="title-maduthuong">Danh sách mã dự thưởng của bạn: </div>
               <div class="maduthuong">
                  <?php 
                  $dsmaduthuong = $d->rawQuery("select ma,dadung from #_maduthuong where id_tv = ? order by id desc ",array($row_detail['id']));
                  for($i=0;$i<count($dsmaduthuong);$i++){
                     if($dsmaduthuong[$i]['dadung']==1){
                        echo '<span class="madadung">'.$dsmaduthuong[$i]['ma'].'</span>';
                     }else{
                        echo '<span>'.$dsmaduthuong[$i]['ma'].'</span>';
                     }
                  }
                  ?>
               </div>
            <?php  } ?>
            <input type="password" id="password" name="password" required placeholder="Nhập mật khẩu" />
            <input type="password" id="new-password" name="new-password" required placeholder="Nhập mật khẩu mới" />
            <input type="password" id="new-password-confirm" name="new-password-confirm" required placeholder="Nhập lại mật khẩu mới" />
            <div class="col-btn">
               <input type="submit" class="btn-acount btn-ky" name="capnhatthongtin" value="Cập nhật " >
            </div>
            <?php if(isset($row_detail['level']) && $row_detail['level']==2){
               $dstvch = $d->rawQuery("select * from #_member where id!= ? and cuahang = ? and hienthi > 0 order by diemthuong desc",array($row_detail['id'],$row_detail['cuahang']));
               if(count($dstvch)>0) {  
                  echo'<div class="title-dstvch">Danh sách thành viên cửa hàng</div>';
                  echo'<div class="flex_row row-dstvch row-dstvch-head "> <div class="col-dstvch">Tên thành viên</div> <div class="col-dstvch">Điểm thưởng</div><div class="col-dstvch">Mã đổi thưởng</div><div class="col-dstvch">Thao tác</div></div>';

                  echo'<div class="dstvch row-dstvch-body">';
                  foreach($dstvch as $k=>$v){ ?>
                     <div class="flex_row row-dstvch row-dstvchit">
                        <div class="col-dstvch">
                           <?= $v['username'] ?>
                        </div>
                        <div class="col-dstvch col-dstvchdiemthuong-<?= $v['id'] ?>">
                           <?= $v['diemthuong'] ?>
                        </div>
                        <div class="col-dstvch col-dstvchmathuong-<?= $v['id'] ?> dstvchmathuong">
                           <?php 
                           $dsmaduthuong = $d->rawQuery("select ma,dadung from #_maduthuong where id_tv = ? order by id desc ",array($v['id']));
                           for($i=0;$i<count($dsmaduthuong);$i++){
                              if($dsmaduthuong[$i]['dadung']==1){
                                 echo '<span class="madadung">'.$dsmaduthuong[$i]['ma'].'</span>';
                              }else{
                                 echo '<span>'.$dsmaduthuong[$i]['ma'].'</span>';
                              }
                           }
                           ?>
                        </div>
                        <div class="col-dstvch">
                           <div class="tangdiem">
                              <input type="number" value="1" name="sodiem" class="sodiem" min="1">
                              <span data-id="<?= $v['id'] ?>">Cộng điểm</span>
                              <i class="fas fa-check tangdiemi-<?= $v['id'] ?>"></i>
                           </div>
                           <div class="doima">
                              <input type="number" value="1" name="soluong" class="soluong" min="1">
                              <span data-id="<?= $v['id'] ?>">Đổi mã</span>
                              <i class="fas fa-check doimai-<?= $v['id'] ?>"></i>
                           </div>
                        </div>
                     </div>
                  <?php }
                  echo'</div>';
               }
               ?>

            <?php } ?>
         </div>
      </form>
   </div>
</div>
</div>
</div>