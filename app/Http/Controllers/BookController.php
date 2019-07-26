<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Book; //use bean的なやつ

use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    //$requestに本の名前、金額、数、公開日のブラウザから受け取った値が入る
    //javaのrequestと同じ
    function store(Request $request){
        //画面の入力値をとる。↓
        //echo $request->item_name . "が入力された";

        /*必須チェックを作成
         *連想配列を生成する $validatorをインポートする
         */
        $validator = Validator::make($request->all(),
            [
                'item_name' =>   'required | min:3 | max:191',
                'item_number' => 'required | min:1 | max:3',
                'item_amount' => 'required | max:6',
                'published' =>   'required'
            ]
            );
        //バリデーションの表示…エラーチェックのこと
        if($validator->fails()){
            return redirect('/')->withInput()-> withErrors($validator);
        }
        $book = new Book(); //$book が Bookクラスのインスタンスのようなもの
        $book -> user_id = Auth::user()->id; //::はjavaでいうところの . のようなもの
        $book ->item_name   = $request ->item_name;
        $book ->item_number = $request ->item_number;
        $book ->item_amount = $request ->item_amount;
        $book ->published   = $request ->published;
        $book ->save();

        return redirect('/');
    }

    function edit(Book $book) {
        //echo $book->item_name; //idで特定した本の情報を取り出す
        return view('bookedit',['book'=>$book]);
    }

    function update(Request $request){
        echo $request -> item_name;

        $validator = Validator::make($request->all(),
            [
                'item_name' =>   'required | min:3 | max:191',
                'item_number' => 'required | min:1 | max:3',
                'item_amount' => 'required | max:6',
                'published' =>   'required'
            ]
            );
        //バリデーションの表示…エラーチェックのこと
        if($validator->fails()){
            return redirect('/')->withInput()-> withErrors($validator);
        }

        //更新処理
        $book = Book::find($request->id); // BookmodelのDBとrequestでとってきたidが一致するレコードのすべて持ってくる。
        $book->item_name = $request->item_name; //カラム名名指しして代入
        $book->item_number = $request->item_number;
        $book->item_amount = $request->item_amount;
        $book->published = $request->published;
        $book->save(); //すべてのレコードがセーブされる
        return  redirect('/');
    }

    //削除
    function destroy(Book $book) {
        //echo $book->id;
        $book->delete();
        return redirect('/');
    }

}
