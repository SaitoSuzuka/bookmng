<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //UTF-8mb4にlarabelは対応　sqlはUTF-8
        //容量が違う 250何文字かlarabelからDBにわたすと容量足りなくなる。
        //AppフォルダのAppServiceProvider.phpの boot関数に入力文字宣言をする。
        //↓'books'はtable名　sがとても大事modelにbookといれるとDBのbooksが繋がる
        Schema::create('books', function (Blueprint $table) {
            //("")はフィールド名　PHPのカラムの書き方
            $table->bigIncrements("id"); //↓に書く id = primary key
            $table->integer("user_id"); //複数のユーザが使える
            $table->string("item_name"); //本の名前
            $table->string("item_number"); //冊数
            $table->integer("item_amount"); //値段
            $table->dateTime("published"); //本の発売日
            $table->timestamps(); //↑にかく
            // timestamp = created at/update atが timestamp型で自動生成される。
            //コマンドプロンプト　php artisan migrateで作成される
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
