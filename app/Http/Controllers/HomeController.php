<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); ///authはログイン情報を管理するもの
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() //home画面を出すメソッド
    {
        /*
        * Bookはmodel $bookはrs。↓のget();はexecuteQueryみたいなもの。全データとって来る。
        *rderby descで　降順　つまり新しい順番(created_atのカラムが)
        *$bookはlist　値を入れた段階でlistと解釈する。
        * 'user_id'(カラム名) = ブラウザで入力したidと同じか Authのuser()メソッドでidが取れてきている。※Authはログイン情報
        */
        $book = Book::where('user_id',Auth::user()->id)->orderby('created_at','desc')->get();
        /*
         *viewの'book' = book.blade.phpに$bookを渡したい
         *javaサーブレット request.setAtribute("book", book)
         * ->jsp <%= map.get("book")%>で取り出しているのと同じこと
         */
        return view('book',['books' => $book]); //key='books' value=$book(list)
        //return view ->getServletContexit().getR...(.jsp)...の機能も含まれる

    }
}
