<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('')->comment('標題');
            $table->unsignedInteger('parent_id')->default('0')->comment('父級id');
            $table->unsignedInteger('order')->default('0')->comment('排序');
            $table->string('slug')->default('')->comment('名稱別名');
            $table->unsignedTinyInteger('is_link')->default(0)->comment('是否外部連結');
            $table->string('link')->default('')->comment('外部連結網址');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
