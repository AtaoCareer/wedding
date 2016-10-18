<?php
    $filename = $_GET['filename'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>匠.爱一生</title>
    <script type="text/javascript" src="//cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./inc/main.css">
</head>
<body>
    <div id="container">
    <audio id="audimp3" src="sound/bgm.mp3" autoplay="" loop=""></audio>
    <img id="shutup" class="shutup lay4" src="./images/shutupk.png">
    <div id="page8" class="page">
        <img id="page8_bg" class="img_bg" src="./images/page8_bg.jpg">
        <img id="point" class="lay1" src="./images/point.png">
        <img id="mask" class="lay2" src="./images/mask_2.png">
        <div id="page7_bar" class="lay1" style="overflow: hidden;">
        <img id="picture" class="lay1" src='<?php echo "./uploadimg/".$filename;?>'>
        </div>
        <img id="page8_bt" class="lay2" src="./images/page8_bt.png">
    </div>
    <form id="form" action="index3.php" method="post" onsubmit="return getValue()">
        <input type="hidden" name="imgname" id="imgname" value="<?php echo $filename; ?>">
        <input type="hidden" name="x" id="x" value="">
        <input type="hidden" name="y" id="y" value="">
        <input type="hidden" name="p" id="p" value="">
        <input type="hidden" name="width" id="width" value="">
        <input type="hidden" name="height" id="height" value="">
        <input type="hidden" name="module" id="module" value="">
    </form>
    </div>
</body>
<script type="text/javascript">

    var x,y,p;
    var cnt=1,biaozhi=1,j=1;
    var count=3;
    var sil;
    var cx,cx1,cy,startX,startY,endX,endY,sx,sy,xs,ys,startX1,endX1,tx=0,ty=0;

    function getValue()
    {
        x=$("#mask").offset().left-$("#picture").offset().left;
        y=$("#mask").offset().top-$("#picture").offset().top;

        width=$("#picture").width();//图片调整之后的宽度
        height = $("#picture").height();

        module=$("#mask").attr("src");
        module=module.substr(-5,1);//看看选择了第几个边框

        $("#x").val(x);
        $("#y").val(y);
        //p是浏览器与720的比值
        $("#p").val(p);

        $("#width").val(width);
        $("#height").val(height);

        $("#module").val(module);

        // alert(p);

        return true;
    }

    $().ready(function(){
        x=parseInt(window.innerWidth);
        y=parseInt(window.innerHeight);
        p=720/x;
        setWidth();
        cx=0;
        cy=0;
        cx1=(x-40/p)/2;



        $('#page8_bt').click(function(){
            location.href="index3.php";
            $("#form").submit();
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

        //切换不同的边框
            $('.layerChose').click(function(){
                var s=$(this).attr('id').substr(5,1);
                $('#layer1').attr('src', './images/layer1.png');
                $('#layer2').attr('src', './images/layer2.png');
                $('#layer'+s).attr('src', './images/layer'+s+'_r.png');
                $('#mask').attr('src', './images/mask_'+s+'.png');
            });

        //照片的移动

        document.getElementById("mask").addEventListener("touchstart", touchStart, false);
        document.getElementById("mask").addEventListener("touchmove", touchMove, false);
        document.getElementById("mask").addEventListener("touchend", touchEnd, false);
    
        function touchStart(event){
            startX = event.touches[0].clientX;
            startY = event.touches[0].clientY;
            sx=startX-cx;  
            sy=startY-cy;
        }
    
    function touchMove(event){
        var touch=event.touches[0];
        var dx=Number(touch.pageX);//手指的x坐标点
        var dy=Number(touch.pageY);//手指的y坐标点
        tx=dx-sx;
        ty=dy-sy;
        $("#picture").css({left:tx+'px',top:ty+'px'});
        var num1=tx*p;
        $('#decX').attr('value',num1);
        var num2=ty*p;
        $('#decY').attr('value',num2);
        cx=tx;
        cy=ty;
        event.preventDefault();
    }
    
    function touchEnd(event){
        endX = event.changedTouches[0].clientX;
        endY = event.changedTouches[0].clientY;
    }
    


        //照片的放大和缩小
        document.getElementById("point").addEventListener("touchstart", touchStart1, false);
        document.getElementById("point").addEventListener('touchmove', touchMove1, false);
        document.getElementById("point").addEventListener("touchend", touchEnd1, false);

        function touchStart1(event)
        {
            startX1 = event.touches[0].clientX;
            sx1 = startX1 - cx1;//看看点击的位置对比原来位置的差
            // console.log('sx1='+sx1);
            // console.log("相对于浏览器的位置x"+event.touches[0].clientX);
            // console.log("相对于浏览器的位置y"+event.touches[0].clientY);
            // console.log("相对于页面的位置x"+event.touches[0].pageX);
            // console.log("相对于页面的位置y"+event.touches[0].pageY);
            // console.log("相对于屏幕的位置x"+event.touches[0].screenX);
            // console.log("相对于屏幕的位置y"+event.touches[0].screenY);

        }

        function touchMove1(event)
        {
            var touch=event.touches[0];
            var dx1 = Number(touch.pageX);
            var tx1 = dx1-sx1;
            // console.log('dx1='+dx1+"tx1="tx1);
            if(tx1>=183/p&&tx1<=(x-40/p)/2){
                $("#point").css({left:tx1+'px'});
                var wx=((<?php echo $_GET['ww'];?>/p)/(<?php echo $_GET['hh'];?>/p));
                var qx=((<?php echo $_GET['hh'];?>/p)/(<?php echo $_GET['ww'];?>/p));
            
            if(<?php echo $_GET['ww'];?>><?php echo $_GET['hh'];?>){
                var orix=y*wx-(y*wx*(1-(((tx1-(183/p))/(175/p))))*0.5);
                var oriy=y-(y*(1-(((tx1-(183/p))/(175/p))))*0.5);
                $('#picture').width(orix*11/16).height(oriy*11/16);    
            }else{
                var oriy=x*qx-(x*qx*(1-(((tx1-(183/p))/(175/p))))*0.5);
                var orix=x-(x*(1-(((tx1-(183/p))/(175/p))))*0.5);
                $('#picture').width(orix*11/16).height(oriy*11/16);
            }   
            }
            if(tx1>=(x-40/p)/2&&tx1<=493/p){
                $("#point").css({left:tx1+'px'});
                var wx=((<?php echo $_GET['ww'];?>/p)/(<?php echo $_GET['hh'];?>/p));
                var qx=((<?php echo $_GET['hh'];?>/p)/(<?php echo $_GET['ww'];?>/p));
                if(<?php echo $_GET['ww'];?>><?php echo $_GET['hh'];?>){
                    var orix=(y*wx)/2+(y*wx*(1+(((tx1-(360/p))/(175/p))))*0.5);
                    var oriy=(y/2)+(y*(1+(((tx1-(360/p))/(175/p))))*0.5);
                    $('#picture').width(orix*11/16).height(oriy*11/16);
                }else{
                    var oriy=(x*qx)/2+(x*qx*(1+(((tx1-(360/p))/(175/p))))*0.5);
                    var orix=(x/2)+(x*(1+(((tx1-(360/p))/(175/p))))*0.5);
                    $('#picture').width(orix*11/16).height(oriy*11/16);
                }   
            }
            cx1 = tx1;
            event.preventDefault();
        }

        function touchEnd1(event)
        {
            endX1 = event.changedTouches[0].clientX;
        }
    });

    function setWidth()
    {
        $("#container").width(x).height(y);
        $('.img_bg').width(x);
        $('.page').width(x).height(y).css({left:0});
        $('#shutup').width(300/p).css({right:-115/p+'px',bottom:0/p+'px'});

        // $('#picture').height(630/p).css({left:-20/p+'px', top:25/p+'px'});
        if (<?php echo $_GET['ww'];?>><?php echo $_GET['hh'];?>) 
        {
            $('#picture').height(722/p);
        }else{
            $('#picture').width(406/p).css({top:64/p+'px'});
        }
        

        $('#mask,#page7_bar').width(406/p).height(723/p).css({left:160/p+'px', top:225/p+'px'});
        $('#page8_bt').width(386/p).css({left:(x-386/p)/2+'px', top:1026/p+'px'});
        $('#point').width(40/p).height(40/p).css({left:(x-40/p)/2+'px', top:992/p+'px'});
    }
</script>
</html>