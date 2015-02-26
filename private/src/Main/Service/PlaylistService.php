<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 20/2/2558
 * Time: 10:36
 */

namespace Main\Service;


use Main\DB\Medoo\MedooFactory;
use Main\Helper\URL;
use Main\View\RedirectView;

class PlaylistService {
    const TABLE = "playlist", TABLE_PLAYLIST_MEDIA = "playlist_media";
    public static function add($params){
        $insert = array(
            "playlist_name"=> $params['playlist_name']
        );

        $db = MedooFactory::getInstance();

        if($db->count(self::TABLE, ["playlist_name"=> $params['playlist_name']]) > 0){
            echo "duplicate name";
            self::http_refresh();
            exit();
        }

        $id = $db->insert(self::TABLE, $insert);
        if(!$id){
            var_dump($db->error());
            exit();
        }

        return ["success"=> true];
    }

    public static function delete($id){
        $db = MedooFactory::getInstance();
        $db->delete(self::TABLE, [
            "playlist_id"=> $id
        ]);

        $db->delete(self::TABLE_PLAYLIST_MEDIA, [
            "playlist_id"=> $id
        ]);

        return ["success"=> true];
    }

    public static function http_refresh($delay = 0, $url = null){
        $content = $delay;
        if(!is_null($url)) $content = $delay.";url=".$url;
        echo '<meta http-equiv="refresh" content="'.$content.'">';
    }
}