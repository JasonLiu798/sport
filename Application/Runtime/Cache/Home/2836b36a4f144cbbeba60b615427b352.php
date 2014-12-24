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

<script src="<?php echo U('Public/bower_components/moment/min/moment.min.js');?>"></script>
<script src="<?php echo U('Public/bower_components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js');?>"></script>


<link rel="stylesheet" href="<?php echo U('Public/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css');?>" />
<link rel="stylesheet" href="<?php echo U('Public/css/activity_create.css');?>">

<script type="text/javascript">
$().ready(function(){
    //taday end
    $('#todayend_date').datetimepicker({
        pickTime: false
    });
    $('#todayend_st').datetimepicker({
        pickDate: false
    });
    $('#todayend_et').datetimepicker({
        pickDate: false
    });
    //days end
    $('#days_date_st').datetimepicker({
        pickTime: false
    });
    $('#days_date_ed').datetimepicker({
        pickTime: false
    });
    $('#days_time_st').datetimepicker({
        pickDate: false
    });
    $('#days_time_ed').datetimepicker({
        pickDate: false
    });
    $('#today_end').show();
    $('#day_end').hide();
    $('#week_end').hide();

    $("#time_type").change(function(){
        var type_str = $(this).val();
        switch(type_str){
            case "today":
                console.log('today');
                $('#today_end').show();
                $('#day_end').hide();
                $('#week_end').hide();
            break;
            case "days":
                console.log('days');
                $('#today_end').hide();
                $('#day_end').show();
                $('#week_end').hide();
            break;
            case "weekends":
                console.log('weekends');
                $('#today_end').hide();
                $('#day_end').show();
                $('#week_end').show();
            break;
        }

    });

    $('#price_detail').hide();
    $('#pricetype1').change(function(){
        if(this.checked){
            $('#price_detail').hide();
        }
    });
    $('#pricetype2').change(function(){
        if(this.checked){
            console.log('choosed');
            $('#price_detail').show();
        }
    });

    //带出市
    $('#province').change(function(){
        var pid = $(this).val();
        $.ajax({
            url: "http://"+window.location.host+"/location/city",
            async: false,
            data: { pid: pid },
            success: function (data) {
                //var tag_id = data.term_id;
                //$('#newtags').append('<span name='+txt+' class="tag tag_new" value="'+tag_id+'">'+txt+'&nbsp;X</span>');
                if ( typeof (data.error) != 'undefined' ) {
                    if (data.error != '') {
                        alert("出错了:"+ data.error);
                    }
                }else{
                    $('#cities').empty();
                    var first_option = new Option(  '请选择城市' , '',true); 
                    $('#cities').append(first_option);
                    for(i=0;i<data.cities.length;i++){
                        var city = data.cities[i];
                        //<option value="today">羽毛球</option>
                        //var city_option = document.createElement('option');
                        var city_option = new Option(  city.name ,city.value ); 
                        // city_option.val(  );
                        // city_option.text( city.name );
                        $('#cities').append(city_option);
                    }
                    $('#city_div').show();
                    $('#area_div').hide();
                }
            },
            error: function (msg) {
                alert(msg.responseText);
            }
        });
    });
    //带出区
    $('#cities').change(function(){
        var cid = $(this).val();
        $.ajax({
            url: "http://"+window.location.host+"/location/area",
            async: false,
            data: { cid: cid },
            success: function (data) {
                //var tag_id = data.term_id;
                //$('#newtags').append('<span name='+txt+' class="tag tag_new" value="'+tag_id+'">'+txt+'&nbsp;X</span>');
                if ( typeof (data.error) != 'undefined' ) {
                    if (data.error != '') {
                        alert("出错了:"+ data.error);
                    }
                }else{
                    $('#areas').empty();
                    var first_option = new Option(  '请选择城区' , '',true); 
                    $('#areas').append(first_option);
                    for(i=0;i<data.areas.length;i++){
                        var area = data.areas[i];
                        //<option value="today">羽毛球</option>
                        //var city_option = document.createElement('option');
                        var area_option = new Option(  area.name ,area.value ); 
                        // city_option.val(  );
                        // city_option.text( city.name );
                        $('#areas').append(area_option);
                    }
                    $('#area_div').show();
                }
            },
            error: function (msg) {
                alert(msg.responseText);
            }
        });

    });
    
    $('#activity_type').change(function(){
        var sid = $(this).val();
        $.ajax({
            url: "http://"+window.location.host+"/sport/subtype",
            async: false,
            data: { sid: sid },
            success: function (data) {
                //var tag_id = data.term_id;
                //$('#newtags').append('<span name='+txt+' class="tag tag_new" value="'+tag_id+'">'+txt+'&nbsp;X</span>');
                if ( typeof (data.error) != 'undefined' ) {
                    if (data.error != '') {
                        alert("出错了:"+ data.error);
                    }
                }else{
                    if(data.sport_types!=null ){
                        $('#sport_type').empty();
                        var first_option = new Option(  '请选择具体分类' , '',true); 
                        $('#sport_type').append(first_option);
                        for(i=0;i<data.sport_types.length;i++){
                            var sport = data.sport_types[i];
                            var sport_option = new Option(  sport.name ,sport.value );
                            $('#sport_type').append(sport_option);
                        }
                        $('#sport_type_div').show();    
                    }
                }
            },
            error: function (msg) {
                alert(msg.responseText);
            }
        });
    });
    
    
});


//百度地图加载
function initialize() {  
    var map = new BMap.Map('map');
    var top_right_navigation = new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_RIGHT, type: BMAP_NAVIGATION_CONTROL_SMALL}); //右上角，仅包含平移和缩放按钮
    var lon = <?php echo ($map_init['lon']); ?>;
    var lat = <?php echo ($map_init['lat']); ?>;
    var point = new BMap.Point(lon, lat);
    map.centerAndZoom(point, 15);

    var marker = new BMap.Marker(point);  // 创建标注
    marker.enableDragging();//可拖拽
    marker.addEventListener("dragend",update_pos);

    map.addOverlay(marker);
    map.addControl(top_right_navigation);

    function update_pos(){
        var p = marker.getPosition();  //获取marker的位置
        $('#lon').val(p.lng);
        $('#lat').val(p.lat);
        console.log('pos:'+p.lng+','+p.lat);
        //alert("marker的位置是" + p.lng + "," + p.lat);  
    }
    
    function G(id) {
        return document.getElementById(id);
    }

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
            marker.setPosition(pp);
            // var marker = new BMap.Marker(pp);  // 创建标注
            // marker.enableDragging();//可拖拽
            // marker.addEventListener("dragend",update_pos);
            update_pos();
            map.centerAndZoom(pp, 18);
            // map.addOverlay(new BMap.Marker(pp));    //添加标注
        }
        var local = new BMap.LocalSearch(map, { //智能搜索
            onSearchComplete: myFun
        });
        local.search(myValue);
    }
    //marker.setAnimation(BMAP_ANIMATION_BOUNCE);
    //var sContent = "<h4 style='margin:0 0 5px 0;padding:0.2em 0'><?php echo ($activity_detail['alocation']); ?></h4>";
    //var infoWindow = new BMap.InfoWindow(sContent);  // 创建信息窗口对象
    /*marker.addEventListener("click", function(){          
       this.openInfoWindow(infoWindow);
       //图片加载完毕重绘infowindow
       // document.getElementById('imgDemo').onload = function (){
       //     infoWindow.redraw();   //防止在网速较慢，图片未加载时，生成的信息框高度比图片的总高度小，导致图片部分被隐藏
       // }
    });
    */
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
    <h2>创建活动</h2>
    <div class="create_help">
        1. 填写活动信息 > 2. 上传活动海报 > 3. 提交活动
    </div>
    <div>
        <form action='<?php echo U('user/login');?>' method='post' id="login_form" class="form-signin" role="form">
            <input type="hidden"   name="lat" id="lat" value="0"/>
            <input type="hidden"   name="lon" id="lon" value="0"/>
<!-- ==================================== name ========================================== -->
            <div class="form-group">
                <label for="activity_name" class="col-sm-2 control-label" >活动名称</label>
                <div class="col-sm-9">
                    <input type="text"   name="activity_name" id="activity_name" class="form-control" value=""  required autofocus/>
                </div>
            </div>
            <div class="clearfix"></div>

<!-- ==================================== type ========================================== -->
            <div class="form-group">
                <label for="activity_type" class="col-sm-2 control-label" >活动类型</label>
                
                <div class="col-sm-3">
                    <select name="activity_type" id="activity_type" class="form-control">
                        <?php if(is_array($activity_types)): foreach($activity_types as $key=>$activity_type): ?><option value="<?php echo ($activity_type['value']); ?>"><?php echo ($activity_type['name']); ?></option><?php endforeach; endif; ?>
                    </select>
                </div>

                <div class="col-sm-3" id="sport_type_div">
                    <select name="sprot_type" id="sport_type" class="form-control">
                        <option value="0">未选择</option>
                    </select>
                </div>
            </div>
            <div class="clearfix"></div>


<!-- ==================================== time ========================================== -->
            <div class="form-group">
                <label for="activity_name" class="col-sm-2 control-label" >活动时间</label>
                <div class="col-sm-3 choose_time_type">
                    <select name="time_type" id="time_type" class="form-control">
                        <option value="today">当天结束</option>
                        <option value="days">持续多天</option>
                        <option value="weekends">每周举行</option>
                    </select>
                </div>

                <div class="col-sm-8 col-sm-offset-2" id="activity_date_detail">
<!-- ____________________________________today ends____________________________________-->
                    <div id="today_end">
                        <div class="floatleft datest">
                            <div class='input-group date' id='todayend_date'>
                                <input type='text' class="form-control" data-date-format="YYYY/MM/DD" placeholder="活动日期"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>

                        <div class="floatleft time1">
                            <div class='input-group date' id='todayend_st'>
                                <input type='text' class="form-control" placeholder="开始时间"/>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                        <div class="floatleft time2">
                            <div class='input-group date floatleft' id='todayend_et'>
                                <input type='text' class="form-control" placeholder="结束时间"/>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                    </div>


                    <div id="week_end">
                        <table class="">
                            <tr>
                                <td>一</td>
                                <td>二</td>
                                <td>三</td>
                                <td>四</td>
                                <td>五</td>
                                <td>六</td>
                                <td>七</td>
                            </tr>
                            <tr>
                                <td><input name="week_days" type="checkbox" value="1"></td>
                                <td><input name="week_days" type="checkbox" value="2"></td>
                                <td><input name="week_days" type="checkbox" value="3"></td>
                                <td><input name="week_days" type="checkbox" value="4"></td>
                                <td><input name="week_days" type="checkbox" value="5"></td>
                                <td><input name="week_days" type="checkbox" value="6"></td>
                                <td><input name="week_days" type="checkbox" value="7"></td>
                            </tr>
                        </table>
                    </div>
<!-- ____________________________________day ends____________________________________-->
                    <div id="day_end">
                        <div class="floatleft days_data_st">
                            <div class='input-group date' id='days_date_st'>
                                <input type='text' class="form-control" data-date-format="YYYY/MM/DD" placeholder="活动开始日期"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="floatleft time_seperator">
                            至
                        </div>
                        <div class="floatleft days_data_ed">
                            <div class='input-group date' id='days_date_ed'>
                                <input type='text' class="form-control" data-date-format="YYYY/MM/DD" placeholder="活动结束日期"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="floatleft days_time_st">
                            <div class='input-group date' id='days_time_st'>
                                <input type='text' class="form-control" placeholder="每日开始时间"/>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                        <div class="floatleft time_seperator">
                            至
                        </div>
                        <div class="floatleft days_time_ed">
                            <div class='input-group date floatleft' id='days_time_ed'>
                                <input type='text' class="form-control" placeholder="每日结束时间"/>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>



                
            </div><!--end of form group time-->
            <div class="clearfix"></div>

<!-- ==================================== location ========================================== -->
            <div class="form-group">
                <div id="location">
                    <label for="activity_location" class="col-sm-2 control-label" >活动地点</label>
                    <div class="col-sm-3" id="location_choose_div">
                        <select name="province" id="province" class="form-control">
                            <option value="">请选择省份</option>
                            <?php if(is_array($provinces)): foreach($provinces as $key=>$province): ?><option value="<?php echo ($province['value']); ?>"><?php echo ($province['name']); ?></option><?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div class="col-sm-3" id="city_div">
                        <select name="cities" id="cities" class="form-control">
                            
                        </select>
                    </div>
                    <div class="col-sm-3" id="area_div">
                        <select name="areas" id="areas" class="form-control">
                            
                        </select>
                    </div>

                    

                    <div class="clearfix"></div>
                    <div class="col-sm-6 col-sm-offset-2">
                        <input type="text" name="activity_location" id="activity_location_text" class="form-control" placeholder="详细地址" />
                    </div>
                    
                    <div class="clearfix"></div>
                    
                    <div class="col-sm-2"></div>

                    <div class="col-sm-6 col-sm-offset-2 map_div">
                        <div id="map" style="width:400px;height:200px"></div>
                        <div id="r-result">
                            <input type="text" id="suggestId" class="form-control" size="50" placeholder="查询活动地点"/>
                        </div>
                                    

                       <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">标注活动地点</button>-->
                    </div>
                    <div id="searchResultPanel" style="border:1px solid #C0C0C0;width:150px;height:auto; display:none;"></div>
                </div><!--end of form group-->
            </div>


            <div class="clearfix"></div>

<!-- ==================================== content ========================================== -->
            <div class="form-group">
                <label for="activity_content" class="col-sm-2 control-label" >活动详情</label>
                <div class="col-sm-9">
                    <textarea name="activity_content" class="form-control" rows="5"></textarea>
                </div>

            </div>

            <div class="clearfix"></div>
<!-- ==================================== price ========================================== -->
            <div class="form-group">
                <label for="activity_content" class="col-sm-2 control-label" >活动费用</label>
                <div class="col-sm-3">
                    <input type="radio" name="pricetype" id="pricetype1" value="F" checked>
                    免费
                </div>
                <div class="col-sm-3">
                    <input type="radio" name="pricetype" id="pricetype2" value="N">
                    收费
                </div>
                <div class="clearfix"></div>

                <div class="col-sm-offset-2 choose_price_type" id="price_detail">
                    <div class="col-sm-2">
                        <select name="area" id="area" class="form-control">
                            <option value="today">门票</option>
                            <option value="days">其他</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" />
                    </div>

                </div>

            </div>
            <div class="clearfix"></div>
        </div>
        </form>
    </div>


</div>
</div>
</div>


<div class="container col-md-12">
	<div class="footer_box">
		<p class="text-center">Copyright &copy; JasonLiu | Powered by Laravel Bootstrap</p>
	</div> 
</div> 
</body>
</html>