## 表设计
### 用户表 user
字段名|用  途	|可取值 |备注
:----|:----|:----|:----
uid|PK| uuid|
username|用户名|6~20|
nickname|昵称|1~64 |
email|邮箱| |密码找回
password|密码|6~15，英文，数字| 
create_time|注册时间||
user_status|用户状态|正常N，注销F|
permission|权限|管理员A，普通L，会员M|
city|城市|int|
star|评价||评分
credit|信用值||好评数

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
fid |被关注的对应类型ID

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

---

### 运动表 sport
字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
sid|PK|uuid||
sname|运动名||
equipment|需要的装备||
venue_type|场馆类型|室内，室外，均可|
iid|图片||
iurl|图片URL||

### 场馆-运动 venue_sport
字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
vid|
asid|PK|auto inc|
provience|省份|
city|城市||
area|地区||
location|具体地点||
sid|运动类型||



### 运动器材表 sport_equipment
字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
seid|PK |auto|
sid|运动||
eid|器材||

### 器材表 equipment
字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
eid |PK | uuid|
ename|器材名| |
iid|图片|

---
### 用户活动表 user_activity
字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
uaid|PK||
uid|用户||
aid|活动||

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
create_time|创建时间||
start_time|开始时间||
end_time|结束时间||
city|城市||
area|区域||
location|详细地址||
lon|经度||
lat|纬度||
price|费用|varchar|
type|FK,类型（wiki形式）| |sid 
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

### 活动器材表
字段名|用  途	|可取值  |备注
:----|:---- |:----|:--
saeid|PK||auto inc
said|活动||
eid|器材||
type||0=已经提供，1=自带|



### 场馆表 venue


### 活动评论表 activity_comment
cid,PK
aid,活动号
uid,用户
content,
create_time,
delete_time,
approved,
pid,

---
## 工具表
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
