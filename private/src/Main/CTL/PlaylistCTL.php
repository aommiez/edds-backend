<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 19/2/2558
 * Time: 16:29
 */

namespace Main\CTL;
use Main\Helper\URL;
use Main\Service\PlaylistService;
use Main\View\HtmlView;
use Main\View\RedirectView;

/**
 * @Restful
 * @uri /playlist
 */
class PlaylistCTL extends BaseCTL {
    /**
     * @GET
     */
    public function index(){
        return new HtmlView("/playlist/index");
    }

    /**
     * @GET
     * @uri /add
     */
    public function actionAddForm(){
        return new HtmlView("/playlist/add");
    }

    /**
     * @POST
     * @uri /add
     */
    public function actionAdd(){
        PlaylistService::add($this->reqInfo->params());
        return new RedirectView(URL::absolute()."/playlist");
    }

    /**
     * @GET
     * @uri /delete/[i:id]
     */
    public function actionDelete(){
        PlaylistService::delete($this->reqInfo->urlParam("id"));
        return new RedirectView(URL::absolute()."/playlist");
    }
}