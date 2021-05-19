

/* Exists */
$.fn.exists = function(){
    return this.length;
};


/* Back to top */
NN_FRAMEWORK.BackToTop = function(){
    $(window).scroll(function(){
        if(!$('.scrollToTop').length) $("body").append('<div class="scrollToTop"><img src="'+GOTOP+'" alt="Go Top"/></div>');
        if($(this).scrollTop() > 100) $('.scrollToTop').fadeIn();
        else $('.scrollToTop').fadeOut();
    });

    $('body').on("click",".scrollToTop",function() {
        $('html, body').animate({scrollTop : 0},800);
        return false; 
    });
};

/* Alt images */
NN_FRAMEWORK.AltImages = function(){
    $('img').each(function(index, element) {
        if(!$(this).attr('alt') || $(this).attr('alt')=='')
        {
            $(this).attr('alt',WEBSITE_NAME);
        }
    });
};

/* Popup */
NN_FRAMEWORK.Popup = function(){
    if($("#fancy-popup").exists())
    {
        $().ready(function(){$(".fancy-popup").fancybox({padding:0,margin:0,wrapCSS:"defaul"});setTimeout(function(){$(".fancy-popup").click();},500);})
    }
};

/* Datetime picker */
NN_FRAMEWORK.DatetimePicker = function(){
    if($('#ngaysinh').exists())
    {
        $('#ngaysinh').datetimepicker({
            timepicker: false,
            format: 'd/m/Y',
            formatDate: 'd/m/Y',
            minDate: '01/01/1950',
            maxDate: TIMENOW
        });
    }
};

NN_FRAMEWORK.loaderwrapper = function(){
    if($("#loader-wrapper").exists()){
        setTimeout(function() {
         $("#loader-wrapper").addClass('show1')
     }, 1000);
        setTimeout(function() {
           $('#loader-wrapper').remove()
       }, 3000);
    }
};

NN_FRAMEWORK.xoaytron = function(){
    if($("#vortex").exists()){
      $(window).bind('load',function(){       
        setTimeout(function(){
            $('#vortex').css({'opacity':'1'});      
            $('#vortex').vortex({
                initialPosition: 220,
                speed: 1200,
                deepFactor:0
            });
            $('.content_vortex').hover(function() {
                $('#vortex').data('vortex').stop();
            }, function() {
                $('#vortex').data('vortex').start();
            });
        },100);
    });
      $('#vortex').css("height",$('#vortex').width());
      $('.content_vortex').css('width', $('#vortex').width());
      $('.content_vortex').css('height', $('#vortex').height());
  }
  if($(".fancybox").exists()){
      $(".fancybox").fancybox();
  }
  if($(".name-account").exists()){
      $(".name-account").click(function(){
        $("#info-account").slideToggle();
    });
  }
  if($(".btn-fancybox-dangnhap").exists())
  {
    $().ready(function(){setTimeout(function(){$(".btn-fancybox-dangnhap").click();},500);})
}
};

/* Diemthuong */
NN_FRAMEWORK.Diemthuong = function(){
    $("body").on("click",".tangdiem span",function(){
        var id = $(this).data("id");
        var sodiem = ($(this).parent().find(".sodiem").val()) ? $(this).parent().find(".sodiem").val() : 0;

        if(id)
        {
            $.ajax({
                url:'ajax/ajax_diemthuong.php',
                type: "POST",
                dataType: 'json',
                async: false,
                data: {cmd:'tangdiem',id:id,sodiem:sodiem},
                success: function(result){
                    $('.col-dstvchdiemthuong-'+id).html(result.diemmoi);
                    $('.tangdiemi-'+id).css({color:"green"});
                    setTimeout(function(){$('.tangdiemi-'+id).css({color:"transparent"});},2000);
                }
            });
        }
    });

    $("body").on("click",".doima span",function(){
        var id = $(this).data("id");
        var soluong = ($(this).parent().find(".soluong").val()) ? $(this).parent().find(".soluong").val() : 0;

        if(id)
        {
            $.ajax({
                url:'ajax/ajax_diemthuong.php',
                type: "POST",
                dataType: 'json',
                async: false,
                data: {cmd:'doima',id:id,soluong:soluong},
                success: function(result){
                    $('.col-dstvchmathuong-'+id).html(result.madutuongtext);
                    $('.col-dstvchdiemthuong-'+id).html(result.diemconlai);
                    if(result.kdc==1){
                        $('.doimai-'+id).removeClass('fa-check');
                        $('.doimai-'+id).addClass('fa-ban');
                        $('.doimai-'+id).css({color:"red"});
                    }else{
                        $('.doimai-'+id).removeClass('fa-ban');
                        $('.doimai-'+id).addClass('fa-check');
                        $('.doimai-'+id).css({color:"green"});
                    }
                    setTimeout(function(){$('.doimai-'+id).css({color:"transparent"});},2000);
                }
            });
        }

    });

    $("body").on("click",".btn-searchgift",function(){
        
        var maduthuong = ($('#maduthuong').val()) ? $('#maduthuong').val() : 0;
        if(maduthuong)
        {
            $.ajax({
                url:'ajax/ajax_diemthuong.php',
                type: "POST",
                dataType: 'json',
                async: false,
                data: {cmd:'doiqua',maduthuong:maduthuong},
                success: function(result){
                    $('.thongbaotext').html(result.thongbao);
                    $('.thongbaoimg').html(result.hinhanh);
                    $().ready(function(){setTimeout(function(){$(".fancy-thongbaoquatang").click();},500);})
                }
            });
        }

    });
};

/* Ready */
$(document).ready(function(){
    NN_FRAMEWORK.loaderwrapper();
    NN_FRAMEWORK.Popup();
    NN_FRAMEWORK.AltImages();
    NN_FRAMEWORK.BackToTop();
    // NN_FRAMEWORK.DatetimePicker();
    /*moi*/
    NN_FRAMEWORK.xoaytron();
    NN_FRAMEWORK.Diemthuong();
});