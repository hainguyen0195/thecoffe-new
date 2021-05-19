<?php
include "ajax_config.php";

$cmd = (isset($_POST['cmd']) && $_POST['cmd'] != '') ? htmlspecialchars($_POST['cmd']) : '';
$id = (isset($_POST['id']) && $_POST['id'] > 0) ? htmlspecialchars($_POST['id']) : 0;


if($cmd == 'tangdiem' && $id > 0 )
{
	$sodiem = (isset($_POST['sodiem']) && $_POST['sodiem'] > 0) ? htmlspecialchars($_POST['sodiem']) : 1;
	$infotv = $d->rawQueryOne("select   id,diemthuong from #_member where id = ? and hienthi > 0 ",array($id));
	$diemmoi=$infotv['diemthuong']+$sodiem;

	$data_diemthuong['diemthuong'] = $diemmoi;
	$d->where('id',$id);
	$d->update('member',$data_diemthuong);

	$data = array('diemmoi' => '<span class="diemmoi" >'.$diemmoi.'</span>');
	echo json_encode($data);
}
else if($cmd == 'doima' && $id > 0 )
{
	$soluong = (isset($_POST['soluong']) && $_POST['soluong'] > 0) ? htmlspecialchars($_POST['soluong']) : 1;
	$infotv = $d->rawQueryOne("select id,diemthuong,maduthuong from #_member where id = ? and hienthi > 0 ",array($id));
	$diemht=$infotv['diemthuong'];
	$diemtru=0;

	$matam='';
	for($i=0;$i<$soluong && $diemht>$diemtru;$i++){
		$data = array();
		$ma= strtoupper($func->stringRandom(5));
		$data['ma'] = $ma;
		$data['id_tv'] = $id;
		$data['dadung'] = 0;
		$data['ngaytao'] = time();
		$data['ngaydung'] = 0;
		if($d->insert('maduthuong',$data)){
			$diemtru+=10;
			$matam.='<span class="mamoi">'.$ma.'</span>';
		}
	}
	$diemconlai=$diemht-$diemtru;
	$data_diemthuong['diemthuong'] = $diemconlai;
	$d->where('id',$id);
	$d->update('member',$data_diemthuong);

	$dsmaduthuong = $d->rawQuery("select ma,dadung from #_maduthuong where id_tv = ? order by id desc ",array($id));
	$maold='';
	for($i=0;$i<count($dsmaduthuong);$i++){
		if($dsmaduthuong[$i]['dadung']==1){
			$maold.='<span class="madadung">'.$dsmaduthuong[$i]['ma'].'</span>';
		}else{
			$maold.='<span>'.$dsmaduthuong[$i]['ma'].'</span>';
		}
	}

	$madutuongtext='';
	$madutuongtext.=$matam;
	$madutuongtext.=' '.$maold;
	$kdc=0;
	if($diemtru==0){
		$kdc=1;
	}
	$data = array('diemconlai' => '<span class="diemmoi" >'.$diemconlai.'</span>','madutuongtext' => $madutuongtext,'kdc' => $kdc);

	echo json_encode($data);
}
else if($cmd == 'doiqua' )
{
	$error=0;
	$thongbao='';
	$hinhanh='<div class="img-gift"><img src="assets/images/buon.png" ></div>';
	if(isset($_SESSION[$login_member])){
		$maduthuong = (isset($_POST['maduthuong']) && $_POST['maduthuong'] != '') ? htmlspecialchars($_POST['maduthuong']) : '';
		
		$infoma = $d->rawQueryOne("select ma,dadung,ngaydung from #_maduthuong where ma = ? ",array($maduthuong));


		if(isset($infoma['ma']) && $infoma['ma']!=''){
			if($infoma['dadung']==1){
				$error=1;
				$thongbao.='Mã của bạn đã sử dụng trước đó vào ngày :'. date("d-m-Y",$infoma['ngaydung']) .')' ;
			}else{
				$r_setting = $d->rawQueryOne("select stt,id from #_setting ");
				$sttng = $r_setting['stt'] + 1;

				$data_setting['stt'] = $sttng;
				$d->where('id',$r_setting['id']);
				$d->update('setting',$data_setting);

				$qua=0;

				switch($sttng)
				{
					case '1':
					case '2':
					case '3':
					case '5':
					case '6':
					case '7':
					$qua = 212;
					break;
					case '4':
					case '8':
					$qua = 213;
					break;
					case '9':
					$qua = 214;
					break;
					default: 
				}

				$gift = $d->rawQueryOne("select tenvi, photo, soluong from #_photo where type = ? and id = ?",array('slidergift',$qua));
				
				$data_gift['soluong'] = $gift['soluong'] - 1;
				$d->where('id',$qua);
				$d->update('photo',$data_gift);
				$hinhanh='<div class="img-gift img-gift-s"><img src="'.THUMBS.'/180x180x1/'.UPLOAD_PHOTO_L.$gift['photo'].'" ></div>';
				$thongbao.='Chúc mừng bạn , Bạn đã giành được giải thưởng là : '.$gift['tenvi']  ;

				$data_maduthuong['dadung'] = 1;
				$data_maduthuong['ngaydung'] = time();
				$d->where('ma',$infoma['ma']);
				$d->update('maduthuong',$data_maduthuong);
			}

		}else{
			$error=1;
			$thongbao.='Mã của bạn không tồn tại.';
		}
	}else{
		$error=1;
		$thongbao.='Vui lòng đăng nhập để tiến hành tìm quà tặng.';
	}

	$data = array('error' => $error,'thongbao' => $thongbao,'hinhanh' => $hinhanh  );

	echo json_encode($data);
}

?>