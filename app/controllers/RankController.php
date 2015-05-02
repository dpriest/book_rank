<?php

class RankController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $ranks = Rank::orderBy('id','desc')->paginate(20);
        $ranks->getFactory()->setViewName('pagination::simple');
        return View::make('ranks.index')->with('ranks', $ranks);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $rank = new Rank();
        return View::make('ranks.edit', array('title' => '新建排名', 'rank' => $rank, 'method' => 'post'));
    }

    public function createBook(Rank $rank)
    {
        $book = new Book();
        return View::make('ranks.editBook', array('title' => '添加书籍', 'rank' => $rank, 'book' => $book, 'method' => 'post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $contents = Input::get('content');
        $name = Input::get('name');
        $input = array(
            'name' => $name,
            'contents' => $contents,
        );
        $rules = array(
            'name' => 'required',
            'contents' => 'required',
        );
        $valid = Validator::make($input, $rules);
        if ($valid->passes()) {
            $list = preg_split('/\r\n|\r|\n/', $contents);
            $rank = array('name' => $name);
            $rank = new Rank($rank);
            $rank->save();
            foreach ($list as $record) {
                $record = trim($record);
                if ($record == '') {
                    continue;
                }
                $list = preg_split('/\s+/', $record);
                $validNames = array();
                foreach($list as $item) {
                    if (is_numeric($item)) {
                        break;
                    }
                    $validNames[] = $item;
                }
                $record = implode(' ', $validNames);
                $book = array('name' => $record, 'mark' => 0, 'mark_users' => 0, 'rank_id' => $rank->id);
                $book = new Book($book);
                $book->save();
            }
            return Redirect::to('ranks')->with('success', 'Rank is saved!');
        }
        else
            return Redirect::back()->withErrors($valid)->withInput();
    }

    public function storeBook($rank) {
        $name = Input::get('name');
        $book = array(
            'rank_id' => $rank->id,
            'name' => $name,
        );
        $rules = array(
            'rank_id' => 'required',
            'name' => 'required',
        );
        $valid = Validator::make($book, $rules);
        if ($valid->passes()) {
            $book = new Book($book);
            $id = $book->save();

            // update mark
            $ins = new RankBooks();
            $ins->updateBook($book);

            return Redirect::to('ranks/' . $rank->id)->with('message', '已添加' . $name);
        }
        else
            return Redirect::back()->withErrors($valid)->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $rank = Rank::find($id);
        return View::make('ranks.single')
            ->with('rank', $rank);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $rank = Rank::find($id);
        $lines = array();
        foreach($rank->books as $book) {
            $lines[] = $book->name;
        }
        $rank->content = implode("\n", $lines);
        return View::make('ranks.edit', array('title' => '新建排名', 'rank' => $rank, 'method' => 'put'));
    }

    public function delete(Rank $rank) {
        $lines = array();
        foreach($rank->books as $book) {
            $lines[] = $book->name;
        }
        $rank->content = implode("\n", $lines);
        return View::make('ranks.edit', array('title' => '新建排名', 'rank' => $rank, 'method' => 'delete'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $rank = Rank::find($id);
        foreach($rank->books as $book) {
            $book->delete();
        }
        $contents = Input::get('content');
        $name = Input::get('name');
        $input = array(
            'name' => $name,
            'contents' => $contents,
        );
        $rules = array(
            'name' => 'required',
            'contents' => 'required',
        );
        $valid = Validator::make($input, $rules);
        if ($valid->passes()) {
            $list = preg_split('/\r\n|\r|\n/', $contents);
            $rank->name = $name;
            $rank->save();
            foreach ($list as $record) {
                $record = trim($record);
                if ($record == '') {
                    continue;
                }
                $list = preg_split('/\s+/', $record);
                $validNames = array();
                foreach($list as $item) {
                    if (is_numeric($item)) {
                        break;
                    }
                    $validNames[] = $item;
                }
                $record = implode('', $validNames);
                $book = array('name' => $record, 'mark' => 0, 'mark_users' => 0, 'rank_id' => $rank->id);
                $book = new Book($book);
                $book->save();
            }
            return Redirect::to('ranks')->with('success', 'Rank is saved!');
        }
        else
            return Redirect::back()->withErrors($valid)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $rank = Rank::find($id);
        $rank->delete();
        return Redirect::to('ranks')->with('success', 'Rank is deleted!');
    }
}
?>