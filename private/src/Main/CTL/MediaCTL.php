<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 19/2/2558
 * Time: 12:21
 */

namespace Main\CTL;
use Main\Helper\URL;
use Main\Service\MediaService;
use Main\View\HtmlView;
use Main\View\RedirectView;


/**
 * @Restful
 * @uri /media
 */
class MediaCTL extends BaseCTL {
    /**
     * @GET
     */
    public function actionIndex(){
        return new HtmlView("/media/index");
    }

    /**
     * @GET
     * @uri /add
     */
    public function actionAddForm(){
        return new HtmlView("/media/add");
    }

    /**
     * @POST
     * @uri /add
     */
    public function actionAdd(){
        MediaService::add($this->reqInfo->params(), $this->reqInfo->files());
        return new RedirectView(URL::absolute()."/media");
    }

    /**
     * @GET
     * @uri /delete/[i:id]
     */
    public function actionDelete(){
        MediaService::delete($this->reqInfo->urlParam("id"));
        return new RedirectView(URL::absolute()."/media");
    }
}