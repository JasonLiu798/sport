<?php
namespace Home\Model;
use Think\Model;
class SportModel extends Model {
    protected $tableName = 'sport';
    protected $pk     = 'sid';

    public function get_sport_type(){
        $res = $this->table('constants')->field('ccontent name,cvalue value')
            ->where(' module=1 ')->order('value')
            ->select();
        return $res;
    }

    public function get_sport_sub_type($type){
        $res = $this->table('sport')->field('sport_name name,sid value')
            ->where('sport_type=%d ',array($type) )->order('value')
            ->select();
        return $res;
        
    }
}