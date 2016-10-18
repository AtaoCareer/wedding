<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wx9dcf603b73eb1a91", "f00469fe3027257112a1f192e79e470e");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>匠.爱一生</title>
  <script type="text/javascript" src="//cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
  <script type="text/javascript" src="./inc/ajaxfileupload.js"></script>
  <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js">//引入微信接口</script>
  <link rel="stylesheet" type="text/css" href="./inc/main.css">
  <script type="text/javascript">
        wx.config({
                
                appId: '<?php echo $signPackage["appId"];?>',
                timestamp: <?php echo $signPackage["timestamp"];?>,
                nonceStr: '<?php echo $signPackage["nonceStr"];?>',
                signature: '<?php echo $signPackage["signature"];?>',
                jsApiList: [
                'onMenuShareTimeline',
                        'onMenuShareAppMessage',
                        'onMenuShareQQ',
                        'onMenuShareWeibo',
                        'chooseImage',
                        'uploadImage'
      // 所有要调用的 API 都要加到这个列表中
                ]
                });
                var shareData = {
                    title:"匠.爱一生",
                    desc: "北汽股份第三届青年集体婚礼", 
                    link: "http://yjyit.baicmotor.com/wedding/index.php", 
                    imgUrl: "http://yjyit.baicmotor.com/wedding/images/icon.png", 
                    success:function(){
                        shareSuccess();
                    }
                };
                wx.ready(function () {
                    wx.onMenuShareAppMessage(shareData);
                    wx.onMenuShareTimeline(shareData);
                });
  </script>
  <style type="text/css">
    #container{
        overflow: hidden;
    }
    .no{
        display: none;
    }
    .lay1{
        position: absolute;
        z-index: 1;
    }
    .lay2{
        position: absolute;
        z-index: 2;
    }
    .lay3{
        position: absolute;
        z-index: 3;
    }
    .lay4{
        position: absolute;
        z-index: 4;
    }
  </style>
  <script type="text/javascript">
        var x,y,p;
        var count=2;
        $().ready(function(){
            x=parseInt(window.innerWidth);
            y=parseInt(window.innerHeight);
            p = 720/x;//以宽为720为一个基准
            setWidth();
            console.log("浏览器宽度为"+x+"px");
            //加载完了之后就是直接显示第一页的动画
            arrow_animation(1);
            //加入手势滑动
            addtouch();


            $("#page6_bt").click(function(){
                $("#page6").fadeOut(500);
                $("#page7").fadeIn(500);
            });

            //音乐开关
            $("#shutup").click(function(){

                var i=$(this).attr('src').substr(15, 1);
                if (i=='k') 
                {
                    $("#shutup").attr('src', './images/shutupg.png');
                    document.getElementById('audimp3').pause();
                }else
                {
                    $('#shutup').attr('src','./images/shutupk.png');
                    document.getElementById('audimp3').play();
                }
            });










            $('#page2_bg').animate({left:-300/p+'px'},30000,function(){
                $('#page2_bg').animate({left:0/p+'px'},30000);
            });
            setInterval(function(){
                $('#page2_bg').animate({left:-300/p+'px'}, 30000, function(){
                    $('#page2_bg').animate({left:0/p+'px'}, 30000);
                });
            },60000);

            $('#page1_bt').click(function(){
                $("#page1").fadeOut(500);
                $("#page2").fadeIn(500);
            });

            $('#arrow_2').click(function(){
                $("#page2").fadeOut(500);
                $("#page3").fadeIn(500);
            });

        });

        function setWidth()
        {
            $('#container').width(x).height(y);
            $('.img_bg').width(x);
            // $('.img_bg').width(x).height(y).css({left:0,top:0});
            $('.page').width(x).height(y).css({left:0});
            $('#arrow_1').width(110/p).css({left:(x-110/p)/2+'px'});
            $('#arrow_2').width(110/p).css({left:(x-110/p)/2+'px'});
            $('#arrow_3').width(110/p).css({left:(x-110/p)/2+'px'});
            $('#arrow_4').width(110/p).css({left:(x-110/p)/2+'px'});
            $('#arrow_5').width(110/p).css({left:(x-110/p)/2+'px'});
            $('#page1').css({top:0+'px'});
            $('#page2').css({top:y+'px'});
            $('#page3').css({top:2*y+'px'});
            $('#page4').css({top:3*y+'px'});
            $('#page5').css({top:4*y+'px'});
            $('#page6').css({top:5*y+'px'});
            $('#page7').css({top:5*y+'px'});

            $('#page6_bt').width(540/p).css({left:(x-540/p)/2+'px',top:890/p+'px'});
            $('#shutup').width(300/p).css({right:-115/p+'px',bottom:0/p+'px'});



            $('.move_bg').height(y).css({left:0,top:0});
            $('#page1_bt').width(421/p).css({left:(x-421/p)/2+'px', top:830/p+'px'});
            
            $('.arrow').width(38/p).css({bottom:67/p+'px'});
            $('#arrow_2').css({right:67/p+'px'});
            $('#fileUpload').css({left:(x-159/p)/2+'px', top:485/p+'px', width:159/p+'px', height:159/p+'px'});
            $('#waiting').width(x).css({left:0, top:0});
        }

        function arrow_animation(i)
        {
            $('#arrow_'+i).animate({bottom:37/p+'px'}, 400, function(){
                $('#arrow_'+i).animate({bottom:17/p+'px'},400);
            });
            setInterval(function(){
                $('#arrow_'+i).animate({bottom:37/p+'px'}, 400, function(){
                $('#arrow_'+i).animate({bottom:17/p+'px'},400);
            });
            }, 800);
        }

        //手指滑动
        function touchStart(event)
        {
            startY = event.touches[0].clientY;
        }

        function touchMove(event)
        {
            event.preventDefault();
        }

        function touchEnd(event)
        {
            endY = event.changedTouches[0].clientY;
            if (startY-endY>30) 
            {
                nextPage();
            }

            else if (endY-startY) 
            {
                prePage();
            }

        }

        function addtouch()
        {
            document.getElementById("container").addEventListener("touchstart", touchStart, false);
            document.getElementById("container").addEventListener("touchmove", touchMove, false);
            document.getElementById("container").addEventListener("touchend", touchEnd, false);
        }

        function removetouch()//一会儿记得关闭
        {
            document.getElementById("container").removeEventListener("touchstart", touchStart, false);
            document.getElementById("container").removeEventListener("touchmove", touchMove, false);
            document.getElementById("container").removeEventListener("touchend", touchEnd, false);
        }

        function nextPage()
        {
            $('.page').animate({top:"-="+y+"px"}, 500);
            //开始下一页的动画 count是页数
            animation(count);
            count++;
        }

        function prePage()
        {
            $('.page').animate({top:"+="+y+"px"}, 500);
            //开始上一页的动画 count是页数
            animation(count);
            count--;
        }
        //第**页的动画
        function animation_2()
        {

        }
        function animation_3()
        {

        }
        function animation_4()
        {
            
        }
        function animation_5()
        {
            // removetouch();//!!!!!!!!哪页是最后一页添加这个
        }

        function animation_6()
        {
            removetouch();//!!!!!!!!哪页是最后一页添加这个
        }
        //各个页面的通知
        function animation(pageNum)
        {
            switch(pageNum)
            {
                case 2:
                animation_2();
                arrow_animation(2);
                break;
                case 3:
                animation_3();
                arrow_animation(3);
                break;
                case 4:
                animation_4();
                arrow_animation(4);
                break;
                case 5:
                animation_5();
                arrow_animation(5);
                break;
                case 6:
                animation_6();
                arrow_animation(6);
                break;
            }
        }

        
  </script>
</head>
<body>
  <div id="container">
    <audio id="audimp3" src="sound/bgm.mp3" autoplay="" loop=""></audio>
    <img id="shutup" class="shutup lay4" src="./images/shutupk.png">
    <div id="page1" class="page">   <!--不能是带有图层顺序的 -->
        <img class="img_bg" src="./images/page1_bg.jpg"> 
        <!-- 每页的背景，class到时候是取宽高用的 --> 
        <!-- <img id="page1_bt" class="lay2" src="./images/page1_bt.png"> -->
        <img id="arrow_1" class="lay1" src="./images/arrow.png">
    </div>
    <div id="page2" class="page">
        <img id="page2_bg" class="img_bg" src="./images/page2_bg.jpg">
        <!-- <img class="img_bg lay2" src="./images/page2_mask.png"> -->
        <img id="arrow_2" class="lay1" src="./images/arrow.png">
        
    </div>

    <div id="page3" class="page">
        <img id="page3_bg" class="img_bg" src="./images/page3_bg.jpg">
        <!-- <img class="img_bg lay2" src="./images/page2_mask.png"> -->
        <img id="arrow_3" class="lay1" src="./images/arrow.png">
    </div>


    <div id="page4" class="page">
        <img id="page4_bg" class="img_bg" src="./images/page4_bg.jpg">
        <!-- <img class="img_bg lay2" src="./images/page2_mask.png"> -->
        <img id="arrow_4" class="lay1" src="./images/arrow.png">
        
    </div>

    <div id="page5" class="page">
        <img id="page5_bg" class="img_bg" src="./images/page5_bg.jpg">
        <!-- <img class="img_bg lay2" src="./images/page2_mask.png"> -->
        <img id="arrow_5" class="lay1" src="./images/arrow.png">
        
    </div>

    <div id="page6" class="page">
        <img id="page6_bg" class="img_bg" src="./images/page6_bg.jpg">
        <img id="page6_bt" class="lay1" src="./images/page6_bt.png">
    </div>

    <div id="page7" class="page no">
        <img id="page7_bg" class="img_bg" src="./images/page7_bg.jpg">
        <img id="waiting" class="img_bg lay4 no" src="./images/waiting.jpg">
        <form id="form1" action="index4.php" method="POST">
           
            <input type="hidden" id="filename" name="filename" value="">
           
            <input type="hidden" id="decX" name="imgleft" value="">
            <input type="hidden" id="decY" name="imgtop" value="">
            
            <input type="hidden" id="decW" name="imgwidth" value="">
            <input type="hidden" id="screenX" name="screenX" value="">
            
        </form>
        <input id="fileUpload" class="lay1" type="file" name="fileUpload" onchange="return ajaxFileUpload('fileUpload');" style="opacity: 0" accept="image/*">

    </div>

    <!-- <div id="page3" class="page">
        <img id="page3_bg" class="img_bg lay1" src="./images/page3_bg.jpg">
        <img id="waiting" class="lay4 no" src="./images/waiting.png">
        <form id="form1" action="index4.php" method="POST">
           
            <input type="hidden" id="filename" name="filename" value="">
           
            <input type="hidden" id="decX" name="imgleft" value="">
            <input type="hidden" id="decY" name="imgtop" value="">
            
            <input type="hidden" id="decW" name="imgwidth" value="">
            <input type="hidden" id="screenX" name="screenX" value="">
            
        </form>
        <input id="fileUpload" class="lay2" type="file" name="fileUpload" onchange="return ajaxFileUpload('fileUpload');" style="opacity: 1" accept="image/*">
        
    </div> -->
    </div>
    <script type="text/javascript">
        function ajaxFileUpload(fileUploadId)
        {
            $("#fileUpload").hide();
            $("#page6_bg").hide();
            $("#waiting").show();
            $.ajaxFileUpload({
                url:'doajaxfileupload.php',
                secureuri:false,
                fileElementId:fileUploadId,
                dataType:'json',
                success:function(data, status)
                {
                    if (typeof(data.error)!='undefined') 
                    {
                        if(data.error!='')
                        {
                            alert(data.error);
                        }else{
                            alert(data.msg);
                        }
                    }
                        else
                        {
                            if (data.msg=='upload success') 
                            {
                                xx = data.w;
                                yy = data.h;
                                location.href = 'index2.php?filename='+data.n+'&ww='+xx+'&hh='+yy;
                                cx = (x-(xx/p))/2;
                                cy = 0;
                                $('#decX').attr('value',(720-(xx))/2);
                                $('#decY').attr('value',228);
                                $('#decW').attr('value',xx);
                            }
                            else{
                                if (data.msg=='Exceed the limit size')
                                {
                                    alert('请上传小于20M的文件');
                                }
                                else if (data.msg=="The suffix is not legal") {
                                    alert('请上传jpg或者png的图片');
                                }
                                else{
                                    alert(data.msg+'上传失败，请重新上传');
                                }
                                $("#fileUpload").show();
                            }
                        }
                    },
                

                error:function(data, status, e){
                    alert(e);
                }
            });
        }
    </script>
      <!-- <div id="p6" class="posit1 dp1">
          <img id="p6_bg" class="img_bg posit1" src="images/p6_bg.jpg">
          <img id="p6_1" class="posit9 dp1" src="images/p6_1.png">
          <form id="form1" action="index4.php" method="POST">
            <input type="hidden" id="filename" name="filename" value>
            <input type="hidden" id="decX" name="imgleft" value>
            <input type="hidden" id="decY" name="imgtop" value>
            <input type="hidden" id="decW" name="imgwidth" value>
            <input type="hidden" id="screenX" name="screenX" value>

              
          </form>
          <input id="fileUpload" class="posit2" type="file" name="fileUpload" onchange="return ajaxFileUpload('fileUpload');" accept="image/*">
      </div> -->
  </div>
  <script type="text/javascript">
        
  </script>
</body>

</html>
