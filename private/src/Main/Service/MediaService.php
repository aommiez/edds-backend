<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 19/2/2558
 * Time: 15:20
 */

namespace Main\Service;


use Main\DB\Medoo\MedooFactory;

class MediaService {
    const TABLE = "media", TABLE_PLAYLIST_MEDIA = "playlist_media", TABLE_PLAYLIST = "playlist", PREFIX = "public/media/";
    public static function add($param, $files){
        if(!isset($files['media']) || !is_uploaded_file($files['media']['tmp_name'])){
            echo 'required media upload';
            self::http_refresh();
            exit();
        }
        $mediaUpload = $files["media"];

        $db = MedooFactory::getInstance();
        if($db->count(self::TABLE, array("media_name"=> $param["media_name"])) > 0){
            echo 'duplicate media name';
            self::http_refresh();
            exit();
        }

        $name = $mediaUpload['name'];
        $ext = array_pop(explode('.', $name));

        // allow mp4, mov, jpg, jpeg, png, gif
        if(!in_array($ext, array("mp4", "jpg", "jpeg", "png", "gif"))){
            echo 'you can upload media mp4 only';
            self::http_refresh();
            exit();
        }
        $newname = uniqid('media').'.'.$ext;
        $des = self::PREFIX.$newname;

        if(!move_uploaded_file($mediaUpload['tmp_name'], $des)){
            echo 'media not upload';
            self::http_refresh();
            exit();
        }

        $insert = array(
            "media_path"=> $newname,
            "media_name"=> $_POST["media_name"]
        );

        $id = $db->insert(self::TABLE, $insert);
        if(!$id){
            var_dump($db->error());
            exit();
        }

        return self::get($id);
    }

    public static function delete($id){
        $db = MedooFactory::getInstance();

        $medias_play = $db->select(self::TABLE_PLAYLIST_MEDIA, "*", ["media_id"=> $id]);
        $ids = array();
        foreach($medias_play as $key=> $value){
            if(in_array($value["playlist_id"], $ids)) continue;

            $ids[] = $value["playlist_id"];

            $playlist = $db->get(self::TABLE_PLAYLIST, "*", array("playlist_id"=> $value["playlist_id"]));
//        var_dump($medias_play, $playlist); exit();

            $db->update(self::TABLE_PLAYLIST, array(
                "version"=> $playlist["version"] + 1
            ), array(
                "playlist_id"=> $playlist["playlist_id"]
            ));
        }

        $db->delete(self::TABLE, [
            "media_id"=> $id
        ]);
        $db->delete(self::TABLE_PLAYLIST_MEDIA, [
            "media_id"=> $id
        ]);

        return ["success"=> true];
    }

    public static function get($id){
        $db = MedooFactory::getInstance();
        $item = $db->get(self::TABLE, "*", [
            "media_id"=> $id
        ]);

        if(!$item) $item = null;

        return $item;
    }

    public static function http_refresh($delay = 0, $url = null){
        $content = $delay;
        if(!is_null($url)) $content = $delay.";url=".$url;
        echo '<meta http-equiv="refresh" content="'.$content.'">';
    }
}