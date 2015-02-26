<?php
/**
 * Created by PhpStorm.
 * User: issarapong
 * Date: 18/2/2558
 * Time: 16:24
 */

namespace Main\CTL;
use Main\Helper\URL;
use Main\Service\EventService;
use Main\View\HtmlView;
use Main\View\RedirectView;

/**
 * @Restful
 * @uri /event
 */
class EventCTL extends  BaseCTL {

    /**
     * @GET
     */
    public function getIndex(){
        return new HtmlView("/event/index");
    }

    /**
     * @GET
     * @uri /add
     */
    public function addForm(){
        return new HtmlView("/event/add");
    }

    /**
     * @POST
     * @uri /add
     */
    public function add(){
        EventService::add($this->reqInfo->params(), $this->reqInfo->files());

        return new RedirectView(URL::absolute("/event"));
    }

    /**
     * @GET
     * @uri /delete/[i:id]
     */
    public function delete(){
        $id = $this->reqInfo->urlParam("id");
        EventService::delete($id);

        return new RedirectView(URL::absolute("/event"));
    }

    /**
     * @GET
     * @uri /edit/[i:id]
     */
    public function editForm(){
        $id = $this->reqInfo->urlParam("id");

        return new HtmlView("/event/edit", ["event_id"=> $id]);
    }

    /**
     * @POST
     * @uri /edit/[i:id]
     */
    public function edit(){
        $id = $this->reqInfo->urlParam("id");
        EventService::edit($id, $this->reqInfo->params(), $this->reqInfo->files());

        return new RedirectView(URL::absolute("/event"));
    }
}