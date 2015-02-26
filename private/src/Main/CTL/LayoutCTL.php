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
 * @uri /layout
 */
class LayoutCTL extends  BaseCTL {

    /**
     * @GET
     */
    public function getIndex(){
        return new HtmlView("/layout_ds/index");
    }
}