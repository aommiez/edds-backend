<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 19/2/2558
 * Time: 15:20
 */

namespace Main\Service;


use Main\DB\Medoo\MedooFactory;
use Main\Helper\ResponseHelper;
use Main\Http\FileUpload;

class MediaService {
    const TABLE = "media", TABLE_PLAYLIST_MEDIA = "playlist_media", TABLE_PLAYLIST = "playlist", PREFIX = "public/media/";
    public static function add($files){
        /**
         * @var FileUpload[] $fileuploads;
         */
        $fileuploads = [];
        foreach($files["medias"]["name"] as $key=> $value){
            if(!isset($files['medias']) || !is_uploaded_file($files['medias']['tmp_name'][$key])){
                return ResponseHelper::error('required media upload');
            }

            $fileupload = FileUpload::load(["name"=> $value, "tmp_name"=> $files["medias"]["tmp_name"][$key]]);
            if(!in_array($fileupload->getExt(), array("mp4", "jpg", "jpeg", "png", "gif"))){
                echo 'You can upload mp4, jpeg, png, gif';
                self::http_refresh();
                exit();
            }
            $fileuploads[] = $fileupload;
        }

        $db = MedooFactory::getInstance();

        foreach($fileuploads as $key=> $fileupload){
            $newname = $fileupload->generateName(true);
            $des = self::PREFIX.$newname;
            $fileupload->move($des);

            $insert = array(
                "media_path"=> $newname,
                "media_name"=> $fileupload->getOriginalName()
            );

            $id = $db->insert(self::TABLE, $insert);
            if(!$id){
                $error = $db->error();
                return ResponseHelper::error($error[0]);
            }
        }

        return ['success'=> true];
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