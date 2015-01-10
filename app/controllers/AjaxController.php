<?php
/**
 * Created by PhpStorm.
 * User: zhangwenhao <zhangwenhao@ganji.com>
 * Date: 1/2/15
 * Time: 18:10
 */

class AjaxController extends \BaseController {

    public function getRank($id) {
        $rank = Rank::find($id);
        echo $rank->books;
    }

    public function postUpdatebook() {
        $ins = new RankBooks();
        $id = Input::get('id');
        $book = Book::find($id);
        $result = $ins->updateBook($book);
        echo $result ? 1 : 0;
    }
} 