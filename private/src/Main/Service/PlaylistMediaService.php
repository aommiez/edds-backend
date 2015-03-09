<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 19/2/2558
 * Time: 15:20
 */

namespace Main\Service;


use Main\DB\Medoo\MedooFactory;

class PlaylistMediaService {
    const TABLE_PLAYLIST_MEDIA = "playlist_media", TABLE_PLAYLIST = "playlist", TABLE_DEVICE = "device", PREFIX = "public/media/";
    public static function add($playlist_id, $params){
        $db = MedooFactory::getInstance();

        $playlist = $db->get(self::TABLE_PLAYLIST, "*", array("playlist_id"=> $playlist_id));

        $max = $db->max(self::TABLE_PLAYLIST_MEDIA, "sort_number", [
            "playlist_id"=> $playlist_id
        ]);

        $insert = array(
            "media_id"=> $params['media_id'],
            "playlist_id"=> $playlist_id,
            "sort_number"=> $max +1
        );


        $id = $db->insert(self::TABLE_PLAYLIST_MEDIA, $insert);
        if(!$id){
            var_dump($db->error());
            exit();
        }

        $update = array(
            "version"=> $playlist["version"] + 1
        );

        $db->update(self::TABLE_PLAYLIST, $update, array(
            "playlist_id"=> $playlist_id
        ));
        $db->update(self::TABLE_DEVICE, ["version[+]"=> 1], ["playlist_id"=> $playlist_id]);

        return [
            "success"=> true
        ];
    }

    public static function delete($id){
        $db = MedooFactory::getInstance();

        $item = $db->get(self::TABLE_PLAYLIST_MEDIA, "*", array("id"=> $id));

        $playlist = $db->get(self::TABLE_PLAYLIST, "*", array("playlist_id"=> $item["playlist_id"]));

        $playlist_id = $item["playlist_id"];

        $db->delete(self::TABLE_PLAYLIST_MEDIA, array("id"=> $id));

        $db->update(self::TABLE_PLAYLIST, array("version"=> $playlist["version"] + 1), array("playlist_id"=> $playlist_id));
        $db->update(self::TABLE_DEVICE, ["version[+]"=> 1], ["playlist_id"=> $playlist_id]);

        return ["success"=> true];
    }
}