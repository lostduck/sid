<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsHasTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_has_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('news_id');
            $table->unsignedBigInteger('tag_id');
			$table->foreign('news_id')->references('id')->on('news');
			$table->foreign('tag_id')->references('id')->on('m_news_tag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		$table->dropForeign('news_has_tags_news_id_foreign');
		$table->dropForeign('news_has_tags_tag_id_foreign');
        Schema::dropIfExists('news_has_tags');
    }
}
