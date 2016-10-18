<?php
	require_once "jssdk.php";
	$jssdk = new JSSDK("wx9dcf603b73eb1a91", "f00469fe3027257112a1f192e79e470e");
	$signPackage = $jssdk->GetSignPackage();




	$filename = $_GET['filename'];
	$fullname = "./mkimg/".$filename;

	
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="inc/main.css" rel="stylesheet" type="text/css">
<script src="//cdn.bootcss.com/jquery/1.11.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="inc/ajaxfileupload.js"></script>

<title>致匠心 领未来</title>
</head>
<body>
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

	<div id="container">
		
    <div id="page10" class="page">
    	<img id="page10_bg" class="img_bg lay1" src="./images/page9_bg.jpg">	
        <img id="picture" class="lay2" src="<?php echo $fullname;?>">
        <img id="page10_bt" class="lay2" src="./images/page10_bt.png">
    </div>
</div>
<script type="text/javascript">
var x,y,p;
/*window.onload=function(){
	$('#container').fadeIn(500,function(){
		zhuzhen();		
	});
}*/
$(document).ready(function() {
	x=parseInt(window.innerWidth);
	y=parseInt(window.innerHeight);
	p=720/x;
	setWidth();  


	
	$('#page10_bt').click(function(){
		location.href="index.php";
	});
	
});


function setWidth(){
	$('#container').width(x).height(y);
	$('.img_bg').width(x);
	$('.pl_bg').height(y).css({left:0,top:0});
	$('.page').width(x).height(y).css({left:0});
	$('#p1_1').width(123/p).css({right:29/p+'px',top:35/p+'px'});
	//p7
	$('#page10').width(x).height(y).css({left:0,top:0});
	$('#picture').width(446/p).css({left:136/p+'px',top:140/p+'px'});
	$('#page10_bt').width(546/p).css({left:(x-546/p)/2+'px',top:910/p+'px'});
}
</script>


</body></html>