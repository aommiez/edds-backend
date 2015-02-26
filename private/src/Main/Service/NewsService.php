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

class NewsService {
    const TABLE = "news", PREFIX = "public/news/";
    public static function add($params, $files){

        //***** upload news*****
        if(!isset($files['news']) || !is_uploaded_file($files['news']['tmp_name'])){
            echo 'required news upload';
            exit();
        }
        $newsUpload = $files["news"];

        $name = $newsUpload['name'];
        $ext = array_pop(explode('.', $name));

        // allow mp4, mov, jpg, jpeg, png, gif
        if(!in_array($ext, array("jpg", "jpeg", "png", "gif"))){
            echo 'you can upload news "jpg","jpeg","png","gif" only';
            exit();
        }
        $newname = uniqid('news').'.'.$ext;
        $des = self::PREFIX.$newname;

        if(!move_uploaded_file($newsUpload['tmp_name'], $des)){
            echo 'news not upload';
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
            "news_path"=> $newname,
            "news_thumbnail_path"=> $thumbnailname,
            "news_name"=> $params["news_name"],
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

        $update = ArrayHelper::filterKey(["news_name"], $params);

        //***** upload news*****

        if(isset($files['news']) && is_uploaded_file($files['news']['tmp_name'])){

            $newsUpload = $files["news"];

            $name = $newsUpload['name'];
            $ext = array_pop(explode('.', $name));

            // allow mp4, mov, jpg, jpeg, png, gif
            if(!in_array($ext, array("jpg", "jpeg", "png", "gif"))){
                echo 'you can upload news "jpg","jpeg","png","gif" only';
                exit();
            }
            $newname = uniqid('news').'.'.$ext;
            $des = self::PREFIX.$newname;

            if(!move_uploaded_file($newsUpload['tmp_name'], $des)){
                echo 'news not upload';
                exit();
            }

            $update["news_path"] = $newname;
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

            $update["news_thumbnail_path"] = $thumbnailname;
        }


        //***** upload thumbnail*****

        $update["updated_at"] = time();

        $db = MedooFactory::getInstance();
        $res = $db->update(self::TABLE, $update, array("news_id"=> $id));

        return self::get($id);
    }

    public static function delete($id){
        $db = MedooFactory::getInstance();
        $db->delete(self::TABLE, array("news_id"=> $id));

        return ["success"=> true];
    }

    public static function get($id){
        $db = MedooFactory::getInstance();
        $item = $db->get(self::TABLE, "*", [
            "news_id"=> $id
        ]);

        if(!$item) $item = null;

        return $item;
    }
}