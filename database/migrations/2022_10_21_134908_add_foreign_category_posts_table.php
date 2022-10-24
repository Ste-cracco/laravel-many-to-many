<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignCategoryPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('slug');

            // Gli diciamo che la colonna 'category_id' si riferisce alla colonna 'id' della tabella 'categories'
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {

            $table->dropForeign('posts_category_id_foreign');   // Nome Relazione = nome tabella_nome colonna_foreign
            // $table->dropForeign(['category_id']); // Alternativa

            $table->dropColumn('category_id');
        });

    }
}
