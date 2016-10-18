<?php
    //微信调用JSSDK
    require_once "jssdk.php";
    $jssdk = new JSSDK("wx9dcf603b73eb1a91", "f00469fe3027257112a1f192e79e470e");
    $signPackage = $jssdk->GetSignPackage();


    // header("Content-type: image/jpeg");
    $name = $_POST['imgname'];
    $x = $_POST['x'];// x小于0 边框在照片左边  x大于0 边框在照片右边
    $y = $_POST['y'];// y小于0 边框在照片上面  y大于0 边框在照片下面
    $p = $_POST['p'];
    // $p = 1.92;
    $width = $_POST['width'];

    $height = $_POST['height'];

   
    $module = $_POST['module'];

    $destination_folder="mkimg/"; //上传文件路径
    if(!file_exists($destination_folder))  
    {  
        mkdir($destination_folder);  
    }
    $uiqueName =  uniqid()."."."jpg";
    $destination = $destination_folder.$uiqueName;
    //目标图像  照片
    $src_src = "./uploadimg/".$name;

    //解决图片颠倒问题////////////////////////////////////////////////////////////
//     $data = imagecreatefromstring(file_get_contents($src_src));
//     $exif = exif_read_data($src_src);
//     // exif信息头, 包含了照片的基本信息, 包括拍摄时间, 颜色, 宽高, 方向
//     if(!empty($exif['Orientation'])) {
// 　　switch($exif['Orientation']) {
// 　　　　case 8:
// 　　　　　　$data = imagerotate($data, 90, 0);
// 　　　　　　break;
// 　　　　case 3:
// 　　　　　　$data = imagerotate($data, 180, 0);
// 　　　　　　break;
// 　　　　case 6:
// 　　　　　　$data = imagerotate($data, -90, 0);
// 　　　　　　break;
// 　　}
// 　　imagejpeg($data, $src_src);
// }
///////////////////////////////////////////////////////////////////
    
    $src_info = getimagesize($src_src); 

    $src_w = $src_info['0'];
    $src_h = $src_info['1'];

    // $image = new SimpleImage(); 
    // $image->load($src_src); 
    // $image->resize($width,$height); 
    // $image->save($src_src);

    $src_im = imagecreatefromjpeg($src_src);

    $new_image = imagecreatetruecolor($width*$p, $height*$p);

    imagecopyresampled($new_image, $src_im, 0, 0, 0, 0, $width*$p, $height*$p, $src_w, $src_h);

    // imagejpeg($new_image);




    $dst_src="./images/mask_".$module.".png";

    $dst_im = imagecreatefrompng($dst_src);

    $dst_info = getimagesize($dst_src);

    $dst_w = $dst_info['0'];
    $dst_h = $dst_info['1'];
    

    // $new_image_1 = imagecreatetruecolor($dst_w/$p, $dst_h/$p);
    // imagecopyresampled($new_image_1, $dst_im, 0, 0, 0, 0, $dst_w/$p, $dst_h/$p, $dst_w, $dst_h);

    // imagepng($new_image_1);


    $bu = imagecreatetruecolor($dst_w, $dst_h);

    //解决黑背景问题
    $color=imagecolorallocate($bu,255,255,255);
    imagecolortransparent($bu,$color);
    imagefill($bu,0,0,$color);


    imagecopyresampled($bu, $new_image, 0 ,0 ,$x*$p ,$y*$p, $width*$p, $height*$p, $width*$p, $height*$p);

    imagedestroy($new_image);


    imagecopyresampled($bu, $dst_im, 0 ,0 ,0 ,0, $dst_w, $dst_h, $dst_w, $dst_h);

    imagedestroy($dst_im);

    // // imagecopy($new_image, $dst_im, 0, 0, 0, 0, $dst_w, $dst_h);

    imagejpeg($bu, $destination);

    // imagejpeg($bu, $destination);


    // imagedestroy($bu);
    // 
    // 
    // 
    // 
    // 
    
    // imagecopy ($new_image, $dst_im, -$x, -$y, 0, 0, $dst_w, $dst_h);

    // imagejpeg($new_image);




    // $src_w = $src_info['0'];
    // $src_h = $src_info['1'];

    // //基准图像  边框
    // $dst_src="./images/mask_".$module.".png";
    // $dst_im = imagecreatefrompng($dst_src);
    // $dst_info = getimagesize($dst_src);

    // $dst_w = $dst_info['0'];
    // $dst_h = $dst_info['1'];


    // imagecopyresampled($new_image_1, $dst_im, 0, 0, 0, 0, $src_w/$p, $height/$p, $src_w, $src_h);
    // imagejpeg($new_image_1, $dst_src);

    // //合并图片
    // //
    // // imagecopymerge($new_image, $dst_im, 0, 0, 0, 0, $dst_w, $dst_h , 100);

    // // imagecopymerge($dst_im, $new_image, 0, 0, $x, $y, $width, $height , 100);
    // // imagejpeg($new_image);
    // imagejpeg($new_image, $src_src);
    // // imagepng($new_image);
    // // imagedestroy($dst_im);
    // // imagedestroy($src_im);

    // // 
    // // $dest = imagecreatefrompng($dst_src);
    // // $src = imagecreatefromjpeg($src_src);
    // // imagealphablending($dest, false);
    // // imagesavealpha($dest, true);
    // // imagecopymerge($src, $dest, 0, 0, 0, 0, 500, 500, 100);
    // // header('Content-Type: image/png');
    // // imagepng($src);
    // // imagedestroy($dest);
    // // imagedestroy($src);
    

    // $png = imagecreatefrompng($dst_src);
    // $jpeg = imagecreatefromjpeg($src_src);

    // list($newwidth, $newheight) = getimagesize($dst_src);

    // list($width, $height) = getimagesize($src_src);

    // // echo "$width"."<br>";
    // // echo "$height";
    
    // $out = imagecreatetruecolor($newwidth, $newheight);
    // // imagejpeg($out);
    // $out1 = imagecreatetruecolor($width, $height);

    // imagecopy($out, $jpeg, 0, 0, 0, 0, $width, $height);

    // // imagejpeg($out);

    // // imagecopy($out, $jpeg, 0, 0, 0, 0, $width, $height);

   
    // imagecopy($out, $png, 0, 0, 0, 0, $newwidth/$p, $newheight/$p);

    // // imagecopyresampled($jpeg, $png, 0, 0, 0, 0, $width, $height, $newwidth, $newheight);

    // // imagejpeg($jpeg);
    

    // imagejpeg($out);
    // // imagejpeg($out, $destination);
    // // imagedestroy($out);
    // // imagedestroy($jpeg);
    // // imagedestroy($png);


?>


    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>匠.爱一生</title>
        <script type="text/javascript" src="//cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js">//引入微信接口</script>
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
                    link: "http://yjyit.baicmotor.com/wedding/index4.php?filename="+"<?php echo $uiqueName;?>", 
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
        <link rel="stylesheet" type="text/css" href="./inc/main.css">
        <script type="text/javascript">
            var x,y,p;
            var cnt=1,biaozhi=1,j=1;
            var count=3;
            var sil;
            var cx,cx1,cy,startX,startY,endX,endY,sx,sy,xs,ys,startX1,endX1,tx=0,ty=0;
            $(document).ready(function() {
                x=parseInt(window.innerWidth);
                y=parseInt(window.innerHeight);
                p=720/x;
                setWidth();  
                cx=0;
                cy=0;
                cx1=(x-40/p)/2;

                //重新生成按钮
                $('#p8_bt_1').click(function(){
                    location.href='index.php?isshow=1';
                });
                //转发的按钮
                $('#page9_bt2').click(function(){
                    $('#forward').fadeIn(500);
                });
                $('#forward').click(function(){
                    $('#forward').fadeOut(500);
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
            });

            function setWidth()
            {
                $('#container').width(x).height(y);
                $('.img_bg').width(x);
                $('.pl_bg').height(y).css({left:0,top:0});
                $('.page').width(x).height(y).css({left:0});
                $('#p1_1').width(123/p).css({right:29/p+'px',top:35/p+'px'});
                $('#shutup').width(300/p).css({right:-115/p+'px',bottom:0/p+'px'});
                //p7
                $('#page9').width(x).height(y).css({left:0,top:0});
                $('#picture').width(446/p).css({left:(x-446/p)/2+'px',top:114/p+'px'});
                $('#page9_bt1').width(400/p).css({left:20/p+'px',top:902/p+'px'});
                $('#page9_bt2').width(400/p).css({right:20/p+'px',top:902/p+'px'});

            }

        </script>
    </head>
    <body>
        <div id="container">
            <audio id="audimp3" src="sound/bgm.mp3" autoplay="" loop=""></audio>
            <img id="shutup" class="shutup lay3" src="./images/shutupk.png">
            <img id="forward" class="img_bg lay4 no" src="./images/forward.png">
            <div id="page9" class="page">
                <img id="page9_bg" class="img_bg" src="./images/page9_bg.jpg">
                <img id="picture" class="lay1" src="<?php echo $destination; ?>">
                <img id="page9_bt1" class="lay2" src="./images/page9_bt1.png">
                <img id="page9_bt2" class="lay2" src="./images/page9_bt2.png">
                
            </div>
        </div>
    </body>
    </html>