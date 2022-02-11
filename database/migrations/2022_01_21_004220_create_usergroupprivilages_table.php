<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsergroupprivilagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usergroupprivilages', function (Blueprint $table) {
            $table->id();
            $table->integer('id_usergroup');
            $table->integer('id_menu');
            $table->smallInteger('has_view');
            $table->smallInteger('has_create');
            $table->smallInteger('has_update');
            $table->smallInteger('has_delete');
            $table->softDeletes();
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
        Schema::dropIfExists('usergroupprivilages');
    }
}
