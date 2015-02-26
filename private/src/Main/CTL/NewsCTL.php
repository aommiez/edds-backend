<?php
/**
 * Created by PhpStorm.
 * User: issarapong
 * Date: 18/2/2558
 * Time: 16:24
 */

namespace Main\CTL;
use Main\Helper\URL;
use Main\Service\NewsService;
use Main\View\HtmlView;
use Main\View\RedirectView;

/**
 * @Restful
 * @uri /news
 */
class NewsCTL extends  BaseCTL {

    /**
     * @GET
     */
    public function getIndex(){
        return new HtmlView("/news/index");
    }

    /**
     * @GET
     * @uri /add
     */
    public function addForm(){
        return new HtmlView("/news/add");
    }

    /**
     * @POST
     * @uri /add
     */
    public function add(){
        NewsService::add($this->reqInfo->params(), $this->reqInfo->files());

        return new RedirectView(URL::absolute("/news"));
    }

    /**
     * @GET
     * @uri /delete/[i:id]
     */
    public function delete(){
        $id = $this->reqInfo->urlParam("id");
        NewsService::delete($id);

        return new RedirectView(URL::absolute("/news"));
    }

    /**
     * @GET
     * @uri /edit/[i:id]
     */
    public function editForm(){
        $id = $this->reqInfo->urlParam("id");

        return new HtmlView("/news/edit", ["news_id"=> $id]);
    }

    /**
     * @POST
     * @uri /edit/[i:id]
     */
    public function edit(){
        $id = $this->reqInfo->urlParam("id");
        NewsService::edit($id, $this->reqInfo->params(), $this->reqInfo->files());

        return new RedirectView(URL::absolute("/news"));
    }
}