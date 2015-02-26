<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 19/2/2558
 * Time: 18:36
 */

namespace Main\Service;


use Main\DB\Medoo\MedooFactory;
use Main\Helper\ArrayHelper;

class EventService {
    const TABLE = "event", PREFIX = "public/event/";
    public static function add($params, $files){

        //***** upload event*****
        if(!isset($files['event']) || !is_uploaded_file($files['event']['tmp_name'])){
            echo 'required event upload';
            exit();
        }
        $eventUpload = $files["event"];

        $name = $eventUpload['name'];
        $ext = array_pop(explode('.', $name));

        // allow mp4, mov, jpg, jpeg, png, gif
        if(!in_array($ext, array("jpg", "jpeg", "png", "gif"))){
            echo 'you can upload event "jpg","jpeg","png","gif" only';
            exit();
        }
        $newname = uniqid('event').'.'.$ext;
        $des = self::PREFIX.$newname;

        if(!move_uploaded_file($eventUpload['tmp_name'], $des)){
            echo 'event not upload';
            exit();
        }


        //***** upload thumbnail*****

        if(!isset($files['thumbnail']) || !is_uploaded_file($files['thumbnail']['tmp_name'])){
            echo 'required thumbnail upload';
            exit();
        }
        $thumbnailUpload = $files["thumbnail"];

        $name = $thumbnailUpload['name'];
        $ext = array_pop(explode('.', $name));

        // allow mp4, mov, jpg, jpeg, png, gif
        if(!in_array($ext, array("jpg", "jpeg", "png", "gif"))){
            echo 'you can upload thumbnail "jpg","jpeg","png","gif" only';
            exit();
        }
        $thumbnailname = uniqid('thumbnail').'.'.$ext;
        $des = self::PREFIX.$thumbnailname;

        if(!move_uploaded_file($thumbnailUpload['tmp_name'], $des)){
            echo 'thumbnail not upload';
            exit();
        }

        // insert script
        $insert = array(
            "event_path"=> $newname,
            "event_thumbnail_path"=> $thumbnailname,
            "event_name"=> $params["event_name"],
            "updated_at"=> time()
        );

        $db = MedooFactory::getInstance();
        $id = $db->insert(self::TABLE, $insert);
        if(!$id){
            var_dump($db->error());
            exit();
        }

        return self::get($id);
    }

    public static function edit($id, $params, $files){

        $update = ArrayHelper::filterKey(["event_name"], $params);

        //***** upload event*****

        if(isset($files['event']) && is_uploaded_file($files['event']['tmp_name'])){

            $eventUpload = $files["event"];

            $name = $eventUpload['name'];
            $ext = array_pop(explode('.', $name));

            // allow mp4, mov, jpg, jpeg, png, gif
            if(!in_array($ext, array("jpg", "jpeg", "png", "gif"))){
                echo 'you can upload event "jpg","jpeg","png","gif" only';
                exit();
            }
            $newname = uniqid('event').'.'.$ext;
            $des = self::PREFIX.$newname;

            if(!move_uploaded_file($eventUpload['tmp_name'], $des)){
                echo 'event not upload';
                exit();
            }

            $update["event_path"] = $newname;
        }

        if(isset($files['thumbnail']) && is_uploaded_file($files['thumbnail']['tmp_name'])){

            $thumbnailUpload = $files["thumbnail"];

            $name = $thumbnailUpload['name'];
            $ext = array_pop(explode('.', $name));

            // allow mp4, mov, jpg, jpeg, png, gif
            if(!in_array($ext, array("jpg", "jpeg", "png", "gif"))){
                echo 'you can upload thumbnail "jpg","jpeg","png","gif" only';
                exit();
            }
            $thumbnailname = uniqid('thumbnail').'.'.$ext;
            $des = self::PREFIX.$thumbnailname;

            if(!move_uploaded_file($thumbnailUpload['tmp_name'], $des)){
                echo 'thumbnail not upload';
                exit();
            }

            $update["event_thumbnail_path"] = $thumbnailname;
        }


        //***** upload thumbnail*****

        $update["updated_at"] = time();

        $db = MedooFactory::getInstance();
        $res = $db->update(self::TABLE, $update, array("event_id"=> $id));

        return self::get($id);
    }

    public static function delete($id){
        $db = MedooFactory::getInstance();
        $db->delete(self::TABLE, array("event_id"=> $id));

        return ["success"=> true];
    }

    public static function get($id){
        $db = MedooFactory::getInstance();
        $item = $db->get(self::TABLE, "*", [
            "event_id"=> $id
        ]);

        if(!$item) $item = null;

        return $item;
    }
}