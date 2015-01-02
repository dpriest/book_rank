<?php
/**
 * Created by PhpStorm.
 * User: zhangwenhao <zhangwenhao@ganji.com>
 * Date: 1/2/15
 * Time: 18:10
 */

class AjaxController extends \BaseController {

    public function ranks($id) {
        $rank = Rank::find($id);
        echo $rank->books;
    }
} 