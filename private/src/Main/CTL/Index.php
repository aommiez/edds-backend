<?php
/**
 * Created by PhpStorm.
 * User: issarapong
 * Date: 18/2/2558
 * Time: 16:24
 */

namespace Main\CTL;
use Main\View\HtmlView;

/**
 * @Restful
 * @uri /
 */
class Index extends  BaseCTL {

    /**
     * @GET
     */
    public function getIndex(){
        return new HtmlView("/index");
    }

}