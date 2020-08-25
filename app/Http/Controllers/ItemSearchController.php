<?php

namespace App\Http\Controllers;

use App\Item;
use App\Article;
use Illuminate\Http\Request;

class ItemSearchController extends Controller
{
    public function index(Request $request) {
        // dd($request->input('search'));
        if($request->has('search')){
            // $items = Item::search('car');
            $items = Item::searchByQuery(
                array(
                    'match' => array(
                        'title' => $request->input('search'),
                        // 'description' => $request->input('search'),
                    )
                )
            );
            // $items = Item::search('car');
            // dd($items);
            return $items;
        }
    }

    public function create(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        $item = Item::create($request->all());
        $item->addToIndex();
        // $item = new Item;
        // $item->title = $request->title;
        // $item->description = $request->desciption;

        // return 1;
        return redirect()->back();
    }

    public function articleSearch(Request $request) {
        if($request->has('search')){
            // dd(1);
            $items = Article::searchByQuery(
                array(
                    'match' => array(
                        'title' => 'review',
                    )
                )
            );
            dd($items);
            return $items;
        }
    }
}
