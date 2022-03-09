<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itffz_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable()->comment('标题');
            $table->integer('pid')->default('0')->nullable()->comment('父级');
            $table->integer('sort')->default('0')->nullable()->comment('排序');
            $table->string('img')->default('')->nullable()->comment('图片');
            $table->string('description')->nullable()->comment('描述');
            $table->string('table_text')->nullable()->comment('表');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itffz_category');
    }
}
