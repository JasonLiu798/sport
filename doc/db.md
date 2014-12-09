# 表设计
## 用户模块
### 用户表 user
字段名|用  途	|可取值 |备注
:----|:----|:----|:----
uid|PK| uuid|
username|用户名|6~20|
nickname|昵称|1~64 |
email|邮箱| |密码找回
password|密码|6~15，英文，数字| 
create_time|注册时间||
user_status|用户状态|def,0;0刚注册，1已经注销，6已验证邮件，|
permission|权限|def:N;管理员A，普通N，会员M|
city|城市|int|
star|评价，评分|def:0,|
credit|信用值|def:0,|好评数

CREATE TABLE `sports`.`user` (

  `uid` BIGINT(20) NOT NULL,
  
  `username` VARCHAR(64) NOT NULL,
  
  `email` VARCHAR(512) NOT NULL,
  
  `password` VARCHAR(128) NOT NULL,
  
  `create_time` DATETIME NOT NULL,
  
  `user_status` CHAR(2) NOT NULL,
  
  `permission` CHAR(2) NOT NULL,
  
  `star` INT NULL,
  
  `credit` VARCHAR(45) NULL,
  
  PRIMARY KEY (`uid`)
);


### 用户关注表 user_follow
关注后，推送相关消息至用户

字段名|用  途	|可取值 |备注
:----|:----|:----|:----
ufid|PK|auto|
uid |用户||
type|关注类型|用户U，活动A，运动S，场馆V，群组G
fid |被关注ID

### 用户评价表 user_evaluate
字段名|用  途	|可取值  |备注
:----|:----|:----|:--
ueid| PK|uuid|
uid  |FK   	|	 |
type| 评价类型|活动发起人U，活动A，场馆V，总体评价T| 
uid|活动发起者| |
vid|场馆| |
aid|活动| |
total_star|平均得出|0~5|
activity_star| 总体评价 |0~5|
initiator_star| 发起人评价，统计至发起人信用| 0~5|
venue_star| 统计至场馆|0~5|
comment|评价内容||


### 用户提醒表 user_remind
推送消息值用户，

字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
urid |PK|auto|
uid  |FK   	|	 |
create_time|创建时间||
content |内容|
is_read|是否阅读|

### 群组表 group
字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
gid|PK|uuid|
groupname|群组名| |
content|群组介绍| |

### 用户群组表 user_group
字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
ugid|PK|auto|
uid| 用户||
gid|群组||
permission|群组角色|创建者C，管理员A|

### 活动评论表 group_comment (1toM)
字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
gcid|PK||
gid|活动||
uid|用户||
content|内容||
create_time|创建时间||
delete_time|删除时间||
approved|赞成数||
pgcid|回复人||

---
## 运动模块

### 运动表 sport
字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
sid|PK|uuid||
sname|运动名||
venue_type|场馆类型|1室内，2室外，3均可|
iid|图片||
iurl|图片URL||
CREATE TABLE `sports`.`sport` (
  `sid` BIGINT NOT NULL,
  `sport_name` VARCHAR(128) NULL,
  `venue_type` VARCHAR(128) NULL,
  `iid` INT NULL,
  `iurl` VARCHAR(512) NULL,
  PRIMARY KEY (`sid`));


### 器材表 equipment
字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
eid |PK | uuid|
ename|器材名| |
sport_type|运动类型|sid|
equipment_type|器材类型||
content|介绍||
iid|图片||
imin_url|小图片url||
imax_url|大图片url||


### 活动器材表 activity_equipment(1-M)
字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
aeid|PK||auto inc
aid|活动||
eid|器材||
type||0=已经提供，1=自带|

---
### 用户活动表 user_activity
字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
uaid|PK||
uid|用户||
aid|活动||
role|角色|C创建人，M成员，|

### 图片表 image
字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
iid |PK | uudi|
name|图片名| |
filename|文件名 | |
filetype|文件类型||
width|宽||
height|高||
size|大小||
uid|创建人|默认为0|
create_time|创建时间||

### 活动表 activity
字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
said|PK||
active_name|活动名称||
create_uid|创建人||
create_time|创建时间||
start_time|开始时间||
end_time|结束时间||
vid|场馆||
province|省份||
city|城市||
area|区域||
location|详细地址||
lon|经度||
lat|纬度||
price|费用|varchar|
sport_type|FK,类型（wiki形式）| |sid 
follow_cnt|已关注人数||
take_cnt|参加人数||
content|详细描述||
permission|参加权限|F自由参加，I邀请参加|
equipment_take|运动器材（自带）||
equipment_got|已提供||
cityarea2show|地点显示用||
imageid|封面ID||
iurl4show|封面图片url||
status|状态|N未传图，P已发布，T已过期|

### 活动-运动 activity_sport
字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
asid|PK||
aid|活动||
sid|运动||


### 场馆表 venue
字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
vid|PK||
vname|场馆名||
vprovance_id|省份||
vcity|城市||
varea_id|区域||
vlocation|场馆详细地址||
vlon|经度||
vlat|纬度||
viid|图片||
vimin_url||
vimax_url||

### 运动-场馆 sport_venue (M-M)
字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
svid|PK|ai|
sid|运动||
vid|场馆||


### 活动评论表 activity_comment (1toM)
字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
cid|PK||
aid|活动||
uid|用户||
content|内容||
create_time|创建时间||
delete_time|删除时间||
approved|赞成数||
pid|回复人||

---
## 工具表
### 常量表 constants
字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
cntid|PK||
type|模块||
cid|常量ID|
value|常量值||


### 序列表
CREATE TABLE `SEQUENCE` (
	`tablename` varchar(30) NOT NULL,
	`nextid` bigint(20) NOT NULL,
	PRIMARY KEY (`tablename`)
) ENGINE=InnoDB 

### 日志表 log
字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
lid|PK||
time|时间||
uid|用户||
type|操作类型|登录LI，登出LO，|
content|操作||

### 图片表
字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
iid|PK||

CREATE TABLE `images` (
  `iid` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `filename` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `filetype` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `uid` bigint(20) DEFAULT NULL,
  `width` int(11) DEFAULT '0',
  `height` int(11) DEFAULT '0',
  `size` int(11) DEFAULT NULL,
  `add_date` datetime DEFAULT NULL,
  PRIMARY KEY (`iid`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_bin


### 地点表
CREATE TABLE `provinces` (
  `id` int(11) NOT NULL auto_increment,
  `provinceid` varchar(20) NOT NULL,
  `province` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ;

CREATE TABLE `cities` (
  `id` int(11) NOT NULL auto_increment,
  `cityid` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `provinceid` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ;

CREATE TABLE `areas` (
  `id` int(11) NOT NULL auto_increment,
  `areaid` varchar(20) NOT NULL,
  `area` varchar(50) NOT NULL,
  `cityid` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
);
