<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo ($title); ?></title>
	<script src="<?php echo U('Public/bower_components/jquery/dist/jquery.min.js');?>"></script>
	<script src="<?php echo U('Public/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
	<link rel="stylesheet" href="<?php echo U('Public/bower_components/bootstrap/dist/css/bootstrap.min.css');?>"/>
    <link rel="stylesheet" href="<?php echo U('Public/css/style.css');?>"/>
    
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
				
				<?php $username = session('username'); ?>

				<ul class="nav navbar-nav navbar-right">
					<?php if(empty( $username )): ?><li><input type="button" class="btn btn-default navbar-btn"
						onclick="javascript:window.location.href='<?php echo U('user/regist');?>';"
						value="注册" /></li>
					<li>&nbsp;&nbsp;&nbsp;</li><?php endif; ?>
						
					<?php if(!empty($username)): ?><li class="dropdown">
					<?php else: ?>
						<li><?php endif; ?>
					
						<?php if(empty( $username )): ?><input type="button" class="btn btn-default navbar-btn" onclick="javascript:window.location.href='<?php echo U('user/login');?>';" value="登录" />
						<?php else: ?>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo ($username); ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo U();?>">个人中心</a></li>
								<li class="divider"></li>
								<li><a href="<?php echo U('user/logout');?>">退出</a></li>
							</ul><?php endif; ?>
					</li>
					
					<!-- <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li> -->
				</ul>
			</div><!-- collapse -->
		</div><!-- container -->
	</div><!-- navbar -->

<script type="text/javascript" src="<?php echo U('Public/baidumap/detail.js');?>"></script>
<!--<script defer="defer" src="<?php echo U('Public/baidumap/SearchInfoWindow_min.js');?>"></script>-->
<link rel="stylesheet" href="<?php echo U('Public/baidumap/SearchInfoWindow_min.css');?>">

<link rel="stylesheet" href="<?php echo U('Public/css/activity_detail.css');?>">

<!--<script src="<?php echo U('Public/bower_components/bootstrap/js/tooltip.js');?>"></script>
<script src="<?php echo U('Public/bower_components/bootstrap/js/popover.js');?>"></script>-->

<!--<script src="http://api.map.baidu.com/api?v=1.5&ak=QnwWrBBxBewxsbWQIoua2DCe"></script>-->
<script type="text/javascript">    
$().ready(function(){
    <?php if(is_array($activity_members)): foreach($activity_members as $key=>$activity_member): ?>$('#head_div<?php echo ($activity_member["uid"]); ?>').popover();<?php endforeach; endif; ?>
    //$("#testbutton").popover();
    $('#creator_head_div').popover();

    $("#follow_activity").click(function(){
        //alert('sdfsdf');
        //console.log('follow activity');
        $.ajax({
            url: "http://"+window.location.host+"/activity/follow",
            async: false,
            data: { aid: <?php echo ($activity_detail['aid']); ?> },
            success: function (data) {
                //var tag_id = data.term_id;
                //$('#newtags').append('<span name='+txt+' class="tag tag_new" value="'+tag_id+'">'+txt+'&nbsp;X</span>');
                if ( typeof (data.error) != 'undefined' ) {
                    if (data.error != '') {
                        alert("出错了:"+ data.error);
                    }
                }else{
                    console.log( 'follow res:'+ data.msg + ',follow_cnt'+ data.follow_cnt );
                    $('#follow_take_btn_li').hide();
                    $('#followed_li').show();
                    $('#taked_li').hide();
                    $('#follow_cnt').text(data.follow_cnt+'人已关注');
                }
                //alert("Data: " + data + "\nStatus: " + status);
            },
            error: function (msg) {
                alert(msg.responseText);
            }
        });
    });

    $('#cancel_follow').click(function(){
        console.log('unfollow');
        $.ajax({
            url: "http://"+window.location.host+"/activity/unfollow",
            async: false,
            data: { aid: <?php echo ($activity_detail['aid']); ?> },
            success: function (data) {
                //var tag_id = data.term_id;
                //$('#newtags').append('<span name='+txt+' class="tag tag_new" value="'+tag_id+'">'+txt+'&nbsp;X</span>');
                if ( typeof (data.error) != 'undefined' ) {
                    if (data.error != '') {
                        alert("出错了:"+ data.error);
                    }
                }else{
                    console.log( 'unfollow res:'+ data.msg +',data.follow_cnt:'+data.follow_cnt );
                    $('#follow_take_btn_li').show();
                    $('#followed_li').hide();
                    $('#taked_li').hide();
                    if(data.follow_cnt==0){
                        $('#follow_cnt').text('暂无人关注');
                    }else{
                        $('#follow_cnt').text( data.follow_cnt+'人已关注');
                    }
                }
                //alert("Data: " + data + "\nStatus: " + status);
            },
            error: function (msg) {
                alert(msg.responseText);
            }
        });
    });

    $("#take_activity,#take_activity_a").click(function(){
        //alert('sdfsdf');
        console.log('take activity');
        $.ajax({
            url: "http://"+window.location.host+"/activity/take",
            async: false,
            data: { aid: <?php echo ($activity_detail['aid']); ?> },
            success: function (data) {
                //var tag_id = data.term_id;
                //$('#newtags').append('<span name='+txt+' class="tag tag_new" value="'+tag_id+'">'+txt+'&nbsp;X</span>');
                if ( typeof (data.error) != 'undefined' ) {
                    if (data.error != '') {
                        alert("出错了:"+ data.error);
                    }
                }else{
                    console.log( 'take res:'+ data.msg +',fc:'+ data.follow_cnt +',tc:'+data.take_cnt );
                    $('#follow_take_btn_li').hide();
                    $('#followed_li').hide();
                    $('#taked_li').show();
                    if(data.follow_cnt == 0){
                        $('#follow_cnt').text('暂无人关注');
                    }else if(data.follow_cnt > 0 && data.follow_cnt !='N'){
                        $('#follow_cnt').text( data.follow_cnt+'人已关注');
                    }
                    $('#take_cnt').text( data.take_cnt+'人已关注');
                }
                //alert("Data: " + data + "\nStatus: " + status);
            },
            error: function (msg) {
                alert(msg.responseText);
            }
        });
    });
    
    $('#cancel_take').click(function(){
        console.log('take');
        $.ajax({
            url: "http://"+window.location.host+"/activity/untake",
            async: false,
            data: { aid: <?php echo ($activity_detail['aid']); ?> },
            success: function (data) {
                //var tag_id = data.term_id;
                //$('#newtags').append('<span name='+txt+' class="tag tag_new" value="'+tag_id+'">'+txt+'&nbsp;X</span>');
                if ( typeof (data.error) != 'undefined' ) {
                    if (data.error != '') {
                        alert("出错了:"+ data.error);
                    }
                }else{
                    //data.take_cnt;
                    console.log( 'unfollow res:'+ data.msg +',tc:'+ data.take_cnt);
                    $('#follow_take_btn_li').show();
                    $('#followed_li').hide();
                    $('#taked_li').hide();
                    if(data.take_cnt==0){
                        $('#take_cnt').text('暂无人参加');
                    }else{
                        $('#take_cnt').text( data.take_cnt+'人已参加');
                    }
                }
            },
            error: function (msg) {
                alert(msg.responseText);
            }
        });
    });


    var ua_status = '<?php echo ($us_status); ?>';
    switch(ua_status){
        case 'F':
            console.log('UA Follow');
            $('#taked_li').hide();
            $('#followed_li').show();
            $('#follow_take_btn_li').hide();
        break;
        case 'T':
            console.log('UA Take');
            $('#taked_li').show();
            $('#followed_li').hide();
            $('#follow_take_btn_li').hide();
        break;
        case 'N':
            console.log('UA no');
            $('#taked_li').hide();
            $('#followed_li').hide();
            $('#follow_take_btn_li').show();
        break;
    }


    


});

//百度地图加载
    function initialize() {
        // var script = document.createElement("script"); 
        // script.src = "http://www.sport.com/Public/baidumap/SearchInfoWindow_min.js";
        // document.body.appendChild(script);

        var map = new BMap.Map('map');
        var top_right_navigation = new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_RIGHT, type: BMAP_NAVIGATION_CONTROL_SMALL}); //右上角，仅包含平移和缩放按钮
        var lon = <?php echo ($activity_detail['lon']); ?>;
        var lat = <?php echo ($activity_detail['lat']); ?>;
        var point = new BMap.Point(lon, lat);
        map.centerAndZoom(point, 15);
        var marker = new BMap.Marker(point);  // 创建标注
        //marker.disableDragging();//不可拖拽    
        function G(id) {
            return document.getElementById(id);
        }
        // var content = '<div style="margin:0;line-height:20px;padding:2px;">' +
        //                 '地址：北京市海淀区上地十街10号<br/>电话：(010)59928888<br/>简介：百度大厦位于北京市海淀区西二旗地铁站附近，为百度公司综合研发及办公总部。' +
        //               '</div>';    
        var content = '<div style="margin:0;line-height:20px;padding:2px;">' +
                        '地址：<?php echo ($activity_detail["alocation"]); ?><br/>' +
                        
                      '</div>';


        //todo tel
        var opts = {
            width : 200,     // 信息窗口宽度
            height: 100,     // 信息窗口高度
            title : "<?php echo ($activity_detail['alocation']); ?>" , // 信息窗口标题
            enableAutoPan:true,
            enableCloseOnClick:true,
            enableMessage:true,//设置允许信息窗发送短息
            message:"活动地点:<?php echo ($activity_detail['alocation']); ?>"
        }

        var infoWindow = new BMap.InfoWindow( content, opts);
        // {
        //     title  : "<?php echo ($activity_detail['alocation']); ?>",      //标题
        //     width  : 290,             //宽度
        //     height : 105,              //高度
        //     panel  : "panel",         //检索结果面板
        //     enableAutoPan : true,     //自动平移
        //     searchTypes   :[
        //         BMAPLIB_TAB_SEARCH,   //周边检索
        //         BMAPLIB_TAB_TO_HERE,  //到这里去
        //         BMAPLIB_TAB_FROM_HERE //从这里出发
        //     ]
        // });

        marker.addEventListener("click", function(e){
            this.openInfoWindow(infoWindow);
            //searchInfoWindow.open(marker);
        });


        map.addOverlay(marker); 
        map.addControl(top_right_navigation);
        /*
        var ac = new BMap.Autocomplete(    //建立一个自动完成的对象
        {
            "input" : "suggestId"
            ,"location" : map
        });

        ac.addEventListener("onhighlight", function(e) {  //鼠标放在下拉列表上的事件
            var str = "";
            var _value = e.fromitem.value;
            var value = "";
            if (e.fromitem.index > -1) {
                value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
            }    
            str = "FromItem<br />index = " + e.fromitem.index + "<br />value = " + value;
            
            value = "";
            if (e.toitem.index > -1) {
                _value = e.toitem.value;
                value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
            }    
            str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
            G("searchResultPanel").innerHTML = str;
        });

        var myValue;
        ac.addEventListener("onconfirm", function(e) {    //鼠标点击下拉列表后的事件
        var _value = e.item.value;
            myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
            G("searchResultPanel").innerHTML ="onconfirm<br />index = " + e.item.index + "<br />myValue = " + myValue;
            
            setPlace();
        });

        function setPlace(){
            //map.clearOverlays();    //清除地图上所有覆盖物
            function myFun(){
                var pp = local.getResults().getPoi(0).point;    //获取第一个智能搜索的结果
                map.centerAndZoom(pp, 18);
                map.addOverlay(new BMap.Marker(pp));    //添加标注
            }
            var local = new BMap.LocalSearch(map, { //智能搜索
                onSearchComplete: myFun
            });
            local.search(myValue);
        }
        */


        //marker.setAnimation(BMAP_ANIMATION_BOUNCE);
        //var sContent = "<h4 style='margin:0 0 5px 0;padding:0.2em 0'><?php echo ($activity_detail['alocation']); ?></h4>";
        //var infoWindow = new BMap.InfoWindow(sContent);  // 创建信息窗口对象
        // marker.addEventListener("click", function(){          
        //    this.openInfoWindow(infoWindow);
        //    //图片加载完毕重绘infowindow
        //    // document.getElementById('imgDemo').onload = function (){
        //    //     infoWindow.redraw();   //防止在网速较慢，图片未加载时，生成的信息框高度比图片的总高度小，导致图片部分被隐藏
        //    // }
        // });
    }


function loadScript() {  
    var script = document.createElement("script");  
    //script.src = "http://api.map.baidu.com/api?v=1.5&ak=QnwWrBBxBewxsbWQIoua2DCe";
    

    script.src = "http://api.map.baidu.com/api?v=2.0&ak=QnwWrBBxBewxsbWQIoua2DCe&callback=initialize";
    document.body.appendChild(script);


    //此为v1.5版本的引用方式  
    // http://api.map.baidu.com/api?v=1.5&ak=您的密钥&callback=initialize";
    //此为v1.4版本及以前版本的引用方式  
    
    
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
                    <?php if($activity_detail['duration'] == 1): ?><!--小于1天-->
                        <li class="activity_item_brief_li">时间：<?php echo date("m月d日 h:i", strtotime($activity_detail['start_time']));?></li>
                    <?php else: ?>
                        <!--大于1天-->
                        <li class="activity_item_brief_li">时间：<?php echo date("m月d日", strtotime($activity_detail['start_time']));?>至<?php echo date("m月d日",strtotime($activity_detail['end_time']));?></li><?php endif; ?>
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
                    <li class="follow_take_cnt_li">
                        <span class="follow_cnt_span" id="follow_cnt">
                            <?php if($activity_detail['follow_cnt'] > 0): echo ($activity_detail['follow_cnt']); ?>人已关注
                            <?php else: ?>
                                暂无人关注<?php endif; ?>
                        </span>
                        <span class="take_cnt_span" id="take_cnt">
                            <?php if($activity_detail['take_cnt'] > 0): echo ($activity_detail['take_cnt']); ?>人已参加
                            <?php else: ?>
                                暂无人参加<?php endif; ?>
                        </span>
                    </li>


                    <li id="follow_take_btn_li">
                        <button type="button" class="btn btn-primary" id="follow_activity">关注</button>
                        <button type="button" class="btn btn-primary" id="take_activity">参加</button>
                    </li>
                    <li id="followed_li">
                        已关注 <a id="cancel_follow" class="cancel" href="#">取消</a> &gt; <a id="take_activity_a" href="#">我要参加</a>
                    </li>
                    <li id="taked_li">
                        已参加 <a id="cancel_take" class="cancel" href="#">取消</a>
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
                <?php if(count($comments) > 0): if(is_array($comments)): foreach($comments as $key=>$comment): ?><tr>
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
                <?php else: ?>
                    暂无发言<?php endif; ?>
            </table>
            <a href="<?php echo U('activitycomment/create');?>/<?php echo ($activity_detail["aid"]); ?>">新建话题</a>
        </div>
        <!--活动内容分享-->
        <div class="activity_share">

        </div>

    </div>



    <div class="col-md-4">
        <div class="map_container">
            地图
            <div id="map" style="width:400px;height:300px"></div>
            <!---->
        </div>
        <div class="activity_initor">
            <h3>活动发起人</h3>
            <div class="activity_member_head" id="creator_head_div" data-container="body" data-animation="true" rel="popover" data-placement="top" data-html="true" data-trigger="hover" 
                data-content="
            <div class='member_float_div'>
                <div class='member_float_head'><img src='<?php echo U('public/image'); echo ($activity_creator['head_iminurl']); ?>'/></div>
                <div class='member_float_head_detail'>
                    <div>
                        <a href='<?php echo U('user/detail');?>/<?php echo ($activity_creator['uid']); ?>'>
                            <?php echo ($activity_creator['username']); ?>
                         </a>
                    </div>
                    <div>发起人</div>
                </div>
            </div>">
                <a href="<?php echo U('user/detail');?>/<?php echo ($activity_creator['uid']); ?>"><img class="activity_member_head_img" src="<?php echo U('public/image'); echo ($activity_creator['head_iminurl']); ?>" /></a>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="activity_member">
            <h3>活动成员(<?php echo ($activity_detail['take_cnt']); ?>人参加，<?php echo ($activity_detail['follow_cnt']); ?>人关注)</h3>
            <?php if(is_array($activity_members)): foreach($activity_members as $key=>$activity_member): ?><div class="activity_member_head" id="head_div<?php echo ($activity_member['uid']); ?>" data-container="body" data-animation="true" rel="popover" data-placement="top" data-html="true" data-trigger="hover" 
                data-content="
                    <div class='member_float_div'>
                        <div class='member_float_head'><img src='<?php echo U('public/image'); echo ($activity_member['head_iminurl']); ?>'/></div>
                        <div class='member_float_head_detail'>
                            <div>
                                <a href='<?php echo U('user/detail');?>/<?php echo ($activity_member['uid']); ?>'>
                                    <?php echo ($activity_member['username']); ?>
                                 </a>
                            </div>
                            <div><?php echo ($activity_member['actype']); ?></div>
                        </div>
                    </div>">
                    <a href="<?php echo U('user/detail');?>/<?php echo ($activity_member['uid']); ?>"><img class="activity_member_head_img" src="<?php echo U('public/image'); echo ($activity_member['head_iminurl']); ?>" /></a>
                </div><?php endforeach; endif; ?>

            <!--<button id="testbutton" type="button" class="btn btn-lg btn-danger" data-container="body" data-animation="true" rel="popover" data-placement="top" data-trigger="hover" data-content="And here's amazing content.">aaa</button>-->
        </div>
        <div class="clearfix"></div>


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