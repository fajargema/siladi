<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();

            $table->string('kode')->index();
            $table->string('title');
            $table->longText('description');
            $table->date('date')->nullable();
            $table->string('location');
            $table->bigInteger('types_id');
            $table->bigInteger('categories_id');
            $table->bigInteger('users_id');
            $table->integer('status')->default(1);
            $table->integer('privacy')->default(1);
            $table->string('attachment')->nullable();
            $table->string('slug')->unique();

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
        Schema::dropIfExists('complaints');
    }
}
