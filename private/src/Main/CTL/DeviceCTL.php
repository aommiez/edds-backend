<?php
/**
 * Created by PhpStorm.
 * User: issarapong
 * Date: 18/2/2558
 * Time: 16:24
 */

namespace Main\CTL;
use Main\Helper\URL;
use Main\Service\DeviceService;
use Main\View\HtmlView;
use Main\View\RedirectView;

/**
 * @Restful
 * @uri /device
 */
class DeviceCTL extends  BaseCTL {

    /**
     * @GET
     */
    public function getIndex(){
        return new HtmlView("/device/index");
    }

    /**
     * @GET
     * @uri /add
     */
    public function addForm(){
        return new HtmlView("/device/add");
    }

    /**
     * @POST
     * @uri /add
     */
    public function add(){
        DeviceService::add($this->reqInfo->params(), $this->reqInfo->files());

        return new RedirectView(URL::absolute("/device"));
    }

    /**
     * @GET
     * @uri /delete/[i:id]
     */
    public function delete(){
        $id = $this->reqInfo->urlParam("id");
        DeviceService::delete($id);

        return new RedirectView(URL::absolute("/device"));
    }

    /**
     * @GET
     * @uri /edit/[i:id]
     */
    public function editForm(){
        $id = $this->reqInfo->urlParam("id");

        return new HtmlView("/device/edit", ["device_id"=> $id]);
    }

    /**
     * @POST
     * @uri /edit/[i:id]
     */
    public function edit(){
        $id = $this->reqInfo->urlParam("id");
        DeviceService::edit($id, $this->reqInfo->params(), $this->reqInfo->files());

        return new RedirectView(URL::absolute("/device"));
    }
}