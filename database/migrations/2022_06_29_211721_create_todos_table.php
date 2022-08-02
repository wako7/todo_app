<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->text('content');
             $table->integer('user_id');
             $table->integer('goal_id');
             $table->integer('position');
             $table->boolean('done')->default(false);
            $table->timestamps();
            $table->integer('status_id')->default(1);
            
            $table->foreign('status_id') // このテーブルの外部キー列
            ->references('id') // 参照先テーブルの ID 列
            ->on('statuses') // 参照先テーブル
            ->onDelete('restrict'); //子テーブルに対象レコードがある場合、親テーブルのレコード削除を禁止
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('todos', function (Blueprint $table) {
        $table->dropForeign(['status_id']);
        });

        Schema::dropIfExists('todos');
    }
}
