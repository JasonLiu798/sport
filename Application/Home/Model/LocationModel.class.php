<?php
namespace Home\Model;
use Think\Model;
class LocationModel extends Model {
    protected $tableName = 'provinces';
    protected $pk     = 'id';

    public function get_provinces(){
        $res = $this->table('provinces')->field('province name,provinceid value')
            ->select();
        return $res;
    }

    public function get_city($pid){
        $res = $this->table('cities')->field('city name,cityid value')
            ->where("provinceid='%s' ",array($pid) )
            ->select();
        return $res;
    }

    public function get_area($cid){
        $res = $this->table('areas')->field('area name,areaid value')
            ->where("cityid = '%s' ",array($cid) )
            ->select();
        return $res;
    }


}