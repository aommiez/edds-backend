<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 19/2/2558
 * Time: 16:39
 */

namespace Main\CTL;
use Main\View\HtmlView;
use Main\DB\Medoo\MedooFactory;
use Main\View\JsonView;
use Main\Service\PlaylistMediaService;
use Main\View\RedirectView;
use Main\Helper\URL;


/**
 * @Restful
 * @uri /playlist/[i:id]/item
 */
class PlaylistItemCTL extends BaseCTL {
    /**
     * @GET
     */
    public function index(){
        $id = $this->reqInfo->urlParam("id");
        return new HtmlView("/playlist_item/index", ["id"=> $id]);
    }

    /**
     * @POST
     * @uri /add
     */
    public function add(){

        $id = $this->reqInfo->urlParam("id");
//        $media_id = $this->reqInfo->param("media_id");

        $params = $this->reqInfo->params();
        PlaylistMediaService::add($id, $params);

        return new RedirectView(URL::absolute("/playlist/{$id}/item"));
    }

    /**
     * @GET
     * @uri /delete/[i:idd]
     */
    public function delete(){

        $playlist_id = $this->reqInfo->urlParam("id");
        $id = $this->reqInfo->urlParam("idd");

//        $params = $this->reqInfo->params();
        PlaylistMediaService::delete($id);

        return new RedirectView(URL::absolute("/playlist/{$playlist_id}/item"));
    }

    /**
     * @POST
     * @uri /sort
     */
    public function sort(){
//        $playlistId = $this->reqInfo->urlParam("id");
        $params = $this->reqInfo->params();

        $table_playlist = "playlist";
        $table = "playlist_media";

        $db = MedooFactory::getInstance();
        $playlist = $db->get($table_playlist, "*", array("playlist_id"=> $params['playlist_id']));

        foreach($params["sort_id"] as $key=> $value){
            $db->update($table, array("sort_number"=> $key + 1), array("id"=> $value));
        }

        $playlist = $db->update($table_playlist, array("version"=> $playlist["version"] + 1), array("playlist_id"=> $params['playlist_id']));

        return new JsonView([
            "success"=> true
        ]);
    }
}