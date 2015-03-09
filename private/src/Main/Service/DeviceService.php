<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 5/3/2558
 * Time: 12:30
 */

namespace Main\Service;


use Main\DB\Medoo\MedooFactory;

class DeviceService extends BaseService {
    private $device_table = "device", $playlist_table = "playlist";

    public function changePlaylist($device_id, $playlist_id){
        $db = MedooFactory::getInstance();
        $db->update($this->device_table, ['playlist_id'=> $playlist_id, "version[+]"=> 1], ["device_id"=> $device_id]);

        return ["success"=> true];
    }

    public function listNoApprove($last_id){
        $db = MedooFactory::getInstance();
        $items = $db->select($this->device_table, "*", ["AND"=> ["device_id[>]"=> $last_id, "approve_status"=> 0]]);
        return $items;
    }

    public function getList($device_id){
        $db = MedooFactory::getInstance();
        $items = $db->get($this->device_table, "*", ["device_id"=> $device_id]);
        return $items;
    }

    public function approveDevice($device_id){
        $db = MedooFactory::getInstance();
        $db->update($this->device_table, ['approve_status'=> 1], ["device_id"=> $device_id]);

        return ["success"=> true];
    }
}