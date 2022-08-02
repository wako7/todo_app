<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreategoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('user_id');
            $table->timestamps();
            $table->datetime('completed_at')->nullable();
            $table->integer('status_id')->default(1);
            $table->datetime('deadline')->nullable();
            $table->integer('label_id')->nullable();
            $table->integer('detail_id')->nullable();
            
            // 外部キー制約
            $table->foreign('status_id') // このテーブルの外部キー列
            ->references('id') // 参照先テーブルの ID 列
            ->on('statuses') // 参照先テーブル
            ->onDelete('restrict'); //子テーブルに対象レコードがある場合、親テーブルのレコード削除を禁止
            
            $table->foreign('label_id')
            ->references('id')
            ->on('labels')
            ->onDelete('restrict');
            
            $table->foreign('detail_id')
            ->references('id')
            ->on('details')
            ->onDelete('restrict');
        });
        
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goals', function (Blueprint $table) {
        $table->dropForeign(['status_id']);
        $table->dropForeign(['label_id']);
        $table->dropForeign(['detail_id']);
        });

        Schema::dropIfExists('goals');
        
    }
}
