<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 19/2/2558
 * Time: 16:23
 */

namespace Main\CTL;
use Main\DB\Medoo\MedooFactory;
use Main\Helper\ResponseHelper;
use Main\Helper\URL;
use Main\View\JsonView;

/**
 * @Restful
 * @uri /api
 */
class ApiCTL extends BaseCTL {
    /**
     * @GET
     */
    public function playlistDevice(){
        $db = MedooFactory::getInstance();

        $table_media = "media";
        $table_playlist = "playlist";
        $table_device = "device";
        $table = "playlist_media";

        $join = array(
            "[>]media"=> array("media_id"=> "media_id")
        );

        $device = $db->get($table_device, "*", ["device_name"=> $_GET['name']]);
        if(!$device){
            $insert = ["device_name"=> $_GET['name'], "register_time"=> time()];
            $id = $db->insert($table_device, $insert);
            $device = $db->get($table_device, "*", ["device_id"=> $id]);
        }

//        $playlist = $db->get($table_playlist, "*", array("playlist_id"=> $device['playlist_id']));

        $items = $db->select($table, $join, '*', ["playlist_id"=> $device['playlist_id'], "ORDER"=> "sort_number"]);
        $prefixdir = 'public/media/';

        $ids = array();
        $medias2 = array();

        foreach($items as $key=> $item){
            $items[$key]['media_url'] = URL::absolute("/").$prefixdir.$item['media_path'];
        }

        foreach($items as $key=> $item){
            if(!in_array($item["media_id"], $ids)){
                $ids[] = $item["media_id"];
                $medias2[] = array(
                    "media_id"=> $item["media_id"],
                    "media_path"=> $item["media_path"],
                    "media_url"=> $item['media_url'],
                    "media_name"=> $item['media_name']
                );
            }
        }

        $playlist["medias_play"] = $items;
        $playlist["medias"] = $medias2;
        $playlist["base_url"] = URL::absolute("/")."public/media/";

        header("Content-Type: application/json");
        echo json_encode($playlist);
    }


    /**
     * @GET
     * @uri /news
     */
    public function news(){
        $table = "news";
        $db = MedooFactory::getInstance();
        $items = $db->select($table, '*');

        foreach($items as $key=> $item){
            $items[$key]["image_url"] = URL::absolute("/public/news/{$item["news_path"]}");
            $items[$key]["news_thumbnail_url"] = URL::absolute("/public/news/{$item["news_thumbnail_path"]}");
            unset($items[$key]["updated_at"]);
        }

        return new JsonView($items);
    }

    /**
     * @GET
     * @uri /event
     */
    public function event(){
        $table = "event";
        $db = MedooFactory::getInstance();
        $items = $db->select($table, '*');

        foreach($items as $key=> $item){
            $items[$key]["image_url"] = URL::absolute("/public/event/{$item["event_path"]}");
            $items[$key]["event_thumbnail_url"] = URL::absolute("/public/event/{$item["event_thumbnail_path"]}");
            unset($items[$key]["updated_at"]);
        }

        return new JsonView($items);
    }

    /**
     * @GET
     * @uri /device
     */
    public function device(){
        $table = "device";
        $db = MedooFactory::getInstance();
        $items = $db->select($table, '*');

        $buff = time() - 20;
        foreach($items as $key=> $item){
            $items[$key]["active"] = $item["last_access"] > $buff;
        }

        return new JsonView($items);
    }

    /**
     * @GET
     * @uri /device/access
     */
    public function deviceAccess(){
        $table = "device";
        $db = MedooFactory::getInstance();

        $condition = ["device_name"=> $this->reqInfo->param("name")];
        if($db->count($table, $condition) == 0){
            return [
                'error'=>[
                    'message'=> "Not found device"
                ]
            ];
        }
        $db->update($table, ["last_access"=> time()], $condition);
        return ["success"=> true];
    }
}