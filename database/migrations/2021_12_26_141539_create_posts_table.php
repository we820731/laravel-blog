<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('')->comment('標題');
            $table->text('introduce')->nullable()->comment('摘要');
            $table->text('content')->nullable()->comment('内容');
            $table->string('slug')->unique()->comment('slug');
            $table->unsignedInteger('category_id')->index()->default(0)->comment('分類id');
            $table->unsignedTinyInteger('is_featured')->index()->default(0)->comment('是否精選');
            $table->string('featured_image')->default('')->comment('精選圖片');
            $table->enum('status',['pending', 'published', 'unpublished'])->comment('文章狀態');
            $table->unsignedInteger('view')->default(0)->comment('瀏覽次數');
            $table->unsignedInteger('order')->default(0)->comment('排序');
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
        Schema::dropIfExists('posts');
    }
}
