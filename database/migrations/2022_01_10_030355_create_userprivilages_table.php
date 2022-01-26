<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPrivilagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userprivilages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user');
            $table->bigInteger('id_menu');
            $table->string('namemenu');
            $table->string('has_create');
            $table->string('has_update');
            $table->string('has_delete');
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
        Schema::dropIfExists('userprivilages');
    }
}
