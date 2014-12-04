<?php
namespace Org\Util;

use Redis;

class TPRedis {
    /**
     * init 
     * @access public
     * @param array $config 数据库配置数组
     */
    public function __construct($config=''){
        if ( !extension_loaded('redis') ) {
            throw_exception(L('_NOT_SUPPERT_').':redis');
        }
        if(empty($options)) {
            $options = array (
                'host'  => C('REDIS_HOST') ? C('REDIS_HOST') : '127.0.0.1',
                'port'  => C('REDIS_PORT') ? C('REDIS_PORT') : 6379,
                //'timeout' => C('DATA_CACHE_TIMEOUT') ? C('DATA_CACHE_TIMEOUT') : false,
                'persistent' => false,
                //'expire'   => C('DATA_CACHE_TIME'),
                'length'   => 0,
            );
        }
        $this->options =  $options;
        $func = $options['persistent'] ? 'pconnect' : 'connect';
        $this->handler  = new Redis;
        $this->connected = $options['timeout'] === false ?
        $this->handler->$func($options['host'], $options['port']) :
        $this->handler->$func($options['host'], $options['port'], $options['timeout']);
    }

    private function isConnected() {
        return $this->connected;
    }

    /**
     * 关闭数据库
     * @access public
    */
    public function close() {
        if($this->handler) {
        	$this->handler->close();
            $this->handler = null;
        }
    }

    public function get($key){
    	N('redis_get',1);
        return $this->handler->get($key);
        //return $this->_redis->get($key);
    }

    public function set($key,$value){
    	N('redis_set',1);
    	return $result = $this->handler->set($key,$value);
    }

    public function incr($key){
    	N('redis_incr',1);
        return $this->handler->incr($key);
    }

}
?>