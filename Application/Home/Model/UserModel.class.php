<?php
namespace Home\Model;

use Think\Model;
use \Org\Util\TPRedis;

class UserModel extends Model {
	
	protected $tableName = 'user';
	protected $pk     = 'uid';
	//protected $fields = array('uid', 'username', 'email', 'password','_type'=>array('uid'=>'bigint','username'=>'varchar','email'=>'varchar','password'=>'int'));
	//protected $insertFields = 'uid,username,email,password,create_time,user_status,permission,star,credit'; // 新增数据的时候允许写入name和email字段
	//protected $updateFields = 'username,email,password,user_status,permission,star,credit';

	/**
	 * 验证条件 （可选）
	 * 包含下面几种情况：
	 * self::EXISTS_VALIDATE 或者0 存在字段就验证（默认）
	 * self::MUST_VALIDATE 或者1 必须验证
	 * self::VALUE_VALIDATE或者2 值不为空的时候验证
	 * 
	 * 验证时间（可选）
	 * self::MODEL_INSERT或者1新增数据时候验证
	 * self::MODEL_UPDATE或者2编辑数据时候验证
	 * self::MODEL_BOTH或者3全部情况下验证（默认）
	 * @var array 
	 */
	protected $_validate = array(
		//username require,unique
		array('username',	'require',	'账号已经存在',		1,	'unique',	3), //新增，修改
		//username format
		array('username',	'/^[A-Za-z0-9_]{6,32}$/',	'请修改帐号格式，只能包含字母、数字或下划线，长度6~32位',	1,	'regex',	3), //新增，修改
		//email format
		array('email',	'email',	'请修改邮箱格式',		1),
		//email require,unique
		array('email',	'require',	'邮箱已经存在',		1,	'unique',	3),

		//password 
		array('password',	'/^[\w~!@#$%^&*]{6,32}$/',	'请修改密码格式，长度6~32位',	2,	'regex',	3), //新增，修改
		array('repassword',	'password',	'请修改确认密码，与密码不一致',	2,'confirm',3),
		//验证码
		//array('verify','require','验证码必须！',	0), //默认情况下用正则进行验证
	);


	public function register(){
				// 从User数据对象创建新的Member数据对象
		// $User = new stdClass();
		// $User->name = 'ThinkPHP';
		// $User->email = 'ThinkPHP@gmail.com';
		// $Member = M("Member");
		// $Member->create($User);

		
		//return $uid;
	}

	




}