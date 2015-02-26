<?php
/**
 * Created by PhpStorm.
 * User: issarapong
 * Date: 18/2/2558
 * Time: 16:50
 */

namespace Main\CTL;
use Main\View\HtmlView;
/**
 * @Restful
 * @uri /Main
 */
class Main extends BaseCTL {

    /**
     * @GET
     */
    public function getIndex(){
        return new HtmlView("/main");
    }
}