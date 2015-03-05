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
     * @POST
     * @uri /change_playlist
     */
    public function changePlaylist(){
        $device_id = $this->reqInfo->param("device_id");
        $playlist_id = $this->reqInfo->param("playlist_id");
        return DeviceService::getInstance()->changePlaylist($device_id, $playlist_id);
    }

    /**
     * @GET
     * @uri /no_approve
     */
    public function listNoApprove(){
        $last_id = $this->reqInfo->param("last_id");
        return DeviceService::getInstance()->listNoApprove($last_id);
    }

    /**
     * @POST
     * @uri /approve_device
     */
    public function approveDevice(){
        $device_id = $this->reqInfo->param("device_id");
        return DeviceService::getInstance()->approveDevice($device_id);
    }
}