<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo ($title); ?></title>
	<script src="<?php echo U('Public/bower_components/jquery/dist/jquery.min.js');?>"></script>
	<script src="<?php echo U('Public/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
	<link rel="stylesheet" href="<?php echo U('Public/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?php echo U('Public/css/style.css');?>">
    
    <!--<script src="http://localhost:3000/socket.io/socket.io.js"></script>-->
	<?php if(isset($next_url)): ?><META HTTP-EQUIV="REFRESH" CONTENT="100;URL=<?php echo ($next_url); ?>?>" /><?php endif; ?>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="<?php echo U('bootstrap/js/html5shiv.min.js');?>"></script>
		<script src="<?php echo U('bootstrap/js/respond.min.js');?>"></script>
	<![endif]-->
<script type="text/javascript">
/*
	$(document).ready(function(){
		@if( !is_null(Session::get('user')) )
			var msgs_x = 0;//$('#msgs_item').offset().top;
			var msgs_y = $('#msgs_item').offset().left;
			var msgs_height = $('#msgs_item').outerHeight();
			var msgs_width = $('#msgs_item').outerWidth();
			console.log("x:"+msgs_x+",y:"+msgs_y);
			console.log("oh:"+msgs_height+",ow:"+msgs_width);
			var msgbox_width = $('#msgbox').outerWidth();
			//msgbox位置
			var msgbox_X = msgs_y+msgs_width*5/8-msgbox_width/2;
			var msgbox_Y = msgs_height*7/8;
			$('#msgbox').css("left",msgbox_X);
			$('#msgbox').css("top",msgbox_Y);
			console.log('box x:'+msgbox_X+',y:'+msgbox_Y);
			
			var msgbox_head_height = $('#msgbox_head').outerHeight();
			var msgbox_head_width = $('#msgbox_head').outerWidth();
			
			var msgbox_head_X = msgbox_X+ msgbox_width/2 - msgbox_head_width ;
			var msgbox_head_Y = msgbox_Y - msgbox_head_height + 5;
			$('#msgbox_head').css('left', msgbox_head_X);
			$('#msgbox_head').css("top",msgbox_head_Y);
	
			//init hide
			$('#msgbox').hide();
			$('#msgbox_head').hide();
			//click msgs_item,show comment diag
			$('#msgs_item').bind('click',function(e){
				stopPropagation(e);//stop bubble
				$('#msgbox').toggle();
				$('#msgbox_head').toggle();
				$('#msgs_count_badge').text('');
				//console.log( $('#msgbox').is(":hidden") );
			});
			//hide comment diag
			$(document).click(function(){
				if($("#msgbox").is(":visible")){
					$('#msgbox').hide();
					$('#msgbox_head').hide();
				}
			});
			//msgbox click stop bubble
			$('#msgbox').bind('click',function(e){
	            stopPropagation(e);
	        });

			var socket = io('http://localhost:3000');
console.log('user:'+{{Session::get('user')}});
			socket.emit('reguser', {{ Session::get('user') }});
			socket.on('newcomm',function(data){
				console.log('NewComm:'+data.cnt );
				$('#msgs_count_badge').text(data.cnt);
				$('#msgbox').text('新评论'+data.cnt+'条');
			});
			
		@endif
		
	});

	function stopPropagation(e) {
        if (e.stopPropagation) 
            e.stopPropagation();
        else 
            e.cancelBubble = true;
    }
    */
// 	$(window).resize(function(){
// 		$('#msgbox').css("left",msgs_count_y+msgs_count_width/2-msgbox_width/2);
// 		$('#msgbox').css("top",msgs_count_x+msgs_count_height);
// 	});
	
</script>
</head>

<body>
	<div class="navbar navbar-default navbar-static-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Sport.com</span> <span class="icon-bar"></span>
					<span class="icon-bar"></span> <span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo U('index');?>">Sport.com</a>
			</div>
			<!-- end of navbar-header -->

			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="<?php echo U();?>">主页</a></li>
					<li><a href="#">关于</a></li>
					
					<?php if(!empty( $username )): ?><li><a href="#" id="msgs_item">消息<span class="badge" id="msgs_count_badge"></span></a></li>
						<div id="msgbox_head"><img id="msgbox_head_img" src="<?php echo U('img/tri.png');?>"/></div>
						<div id="msgbox">
						新评论x条
							<!--<ul class="list-group">
							  <li class="list-group-item"></li>
							   <li class="list-group-item">Dapibus ac facilisis in</li> 
							</ul>-->
						</div><?php endif; ?>
					
					
					<li><form class="navbar-form">
					<input class="span2" type="text" placeholder="搜一下">
					<button type="submit" class="btn">搜索</button>
				</form></li>
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
						
					<?php if(empty( $username )): ?><li><input type="button" class="btn btn-default navbar-btn"
						onclick="javascript:window.location.href='<?php echo U('user/regist');?>';"
						value="注册" /></li>
					<li>&nbsp;&nbsp;&nbsp;</li><?php endif; ?>
						
					<?php if(!empty( $username )): ?><li class="dropdown">
					<?php else: ?>
						<li><?php endif; ?>
					
					<?php if(empty( $username )): ?><input type="button" class="btn btn-default navbar-btn" onclick="javascript:window.location.href='<?php echo U('user/login');?>';" value="登录" />
					<?php else: ?>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo ($username); ?><b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo U();?>">文章管理</a></li>
							<li><a href="#">设置</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo U('user/logout');?>">退出</a></li>
						</ul><?php endif; ?>
						</li>
					
					<!-- <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li> -->
				</ul>
			</div><!-- collapse -->
		</div><!-- container -->
	</div><!-- navbar -->
<link rel="stylesheet" href="<?php echo U('Public/css/activity_detail.css');?>">

<!--<script src="http://api.map.baidu.com/api?v=1.5&ak=QnwWrBBxBewxsbWQIoua2DCe"></script>-->
<script type="text/javascript">  
function initialize() {  
    var map = new BMap.Map('map');
    var top_right_navigation = new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_RIGHT, type: BMAP_NAVIGATION_CONTROL_SMALL}); //右上角，仅包含平移和缩放按钮
    var lon = <?php echo ($activity_detail['lon']); ?>;
    var lat = <?php echo ($activity_detail['lat']); ?>;
    var point = new BMap.Point(lon, lat);
    map.centerAndZoom(point, 15);
    var marker = new BMap.Marker(point);  // 创建标注
    map.addOverlay(marker); 
    map.addControl(top_right_navigation);
    //marker.setAnimation(BMAP_ANIMATION_BOUNCE);
    var sContent = "<h4 style='margin:0 0 5px 0;padding:0.2em 0'><?php echo ($activity_detail['alocation']); ?></h4>";
    var infoWindow = new BMap.InfoWindow(sContent);  // 创建信息窗口对象
    marker.addEventListener("click", function(){          
       this.openInfoWindow(infoWindow);
       //图片加载完毕重绘infowindow
       // document.getElementById('imgDemo').onload = function (){
       //     infoWindow.redraw();   //防止在网速较慢，图片未加载时，生成的信息框高度比图片的总高度小，导致图片部分被隐藏
       // }
    });
}
   
function loadScript() {  
    var script = document.createElement("script");  
    script.src = "http://api.map.baidu.com/api?v=1.5&ak=QnwWrBBxBewxsbWQIoua2DCe&callback=initialize";
    //此为v1.5版本的引用方式  
    // http://api.map.baidu.com/api?v=1.5&ak=您的密钥&callback=initialize"; 
    //此为v1.4版本及以前版本的引用方式  
    document.body.appendChild(script);  
}

window.onload = loadScript;  
</script>  

<div class="container">
<div class="row">
<div class="col-md-10 col-md-offset-1">
    <div class="col-md-8">
        <div class="detail_up">
            <div class="detail_cover">
                <img class="detail_cover_img" src="<?php echo U('Public/image'); echo ($activity_detail['aimax_url']); ?>"/>
            </div>
            <div class="detail_point">

                <ul class="detail_point_ul">
                    <li><h3><?php echo ($activity_detail['activity_name']); ?></h3></li>
                    <?php if($iact["duration"] == 1): ?><!--小于1天-->
                        <li class="activity_item_brief_li">时间：<?php echo date("m月d日 h:i", strtotime($activity_detail['start_time']));?></li>
                    <?php else: ?>
                        <!--大于1天-->
                        <li class="activity_item_brief_li">时间：<?php echo date("m月d日", strtotime($iact.start_time));?>至<?php echo date("m月d日",strtotime($activity_detail['end_time']));?></li><?php endif; ?>
                    <li>地点：<?php echo ($activity_detail['cityarea2show']); ?>&nbsp;<?php echo ($activity_detail['alocation']); ?></li>
                    <li>
                        <?php switch($activity_detail["pricetype"]): case "F": ?>费用：免费<?php break;?>
                            <?php case "M": ?>门票：<?php echo ($activity_detail['price']); break;?>
                            <?php case "A": ?>费用：<?php echo ($activity_detail['price']); break; endswitch;?>
                    </li>
                    <li>类型：<?php echo ($activity_detail['atype']); ?>-<?php echo ($activity_detail['sport_name']); ?></li>
                    <?php if($activity_detail['equipment_take'] != null): ?><li>需自带器械：<?php echo ($activity_detail['equipment_take']); ?></li><?php endif; ?>
                    <?php if($activity_detail['equipment_got'] != null): ?><li>已提供器械：<?php echo ($activity_detail['equipment_got']); ?><li><?php endif; ?>
                    <li>发起人：<a href=""><?php echo ($activity_detail['username']); ?></a></li>
                    <li>
                        <?php if($activity_detail['follow_cnt'] < 0): echo ($activity_detail['follow_cnt']); ?>人已关注
                        <?php else: ?>
                            暂无人关注<?php endif; ?>
                        <?php if($activity_detail['take_cnt'] < 0): echo ($activity_detail['take_cnt']); ?>人想参加
                        <?php else: ?>
                            暂无人参加<?php endif; ?>
                    </li>
                    <li>
                        <button type="button" class="btn btn-primary" id="follow_activity">关注</button>
                        <button type="button" class="btn btn-primary" id="take_activity">参加</button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="detail_bottom">
            <h3>活动详情</h3>
            <?php echo ($activity_detail['acontent']); ?>
        </div>
        <div class="activity_comment">
            <h3>活动讨论</h3>
            <table class="table">
                <?php if(is_array($comments)): foreach($comments as $key=>$comment): ?><tr>
                        <td><a href=""><?php echo ($comment['accontent']); ?></a></td>
                        <td>来自<a href=""><?php echo ($comment['username']); ?></a></td>
                        <td><?php if($comment['fcnt'] > 0): echo ($comment['fcnt']); ?>人回应<?php endif; ?>
                        </td>
                        <td>
                            <?php if(floor((strtotime($comment['create_time'])-floor(strtotime(date('Y-m-d'))) )/86400) > 0): echo date('Y-m-d',strtotime($comment['create_time']));?>
                            <?php else: ?>
                                <?php echo date('H:i',$comment['create_time']); endif; ?>
                        </td>
                    </tr><?php endforeach; endif; ?>
            </table>
        </div>
    </div>

    <div class="col-md-4">
        <div class="map_container">
            地图
            <div id="map" style="width:300px;height:300px"></div>
        </div>
        <div> 标签</div>
    </div>


</div><!--end of col -->
</div><!--end of row-->
</div><!--end of container-->


<div class="container col-md-12">
	<div class="footer_box">
		<p class="text-center">Copyright &copy; JasonLiu | Powered by Laravel Bootstrap</p>
	</div> 
</div> 
</body>
</html>