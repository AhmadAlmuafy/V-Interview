<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datasets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('data_set_name', 255);
            $table->string('data_set_url', 255);
            $table->unsignedBigInteger("company_id");
            $table->foreign("company_id")
            -> references("id")
            -> on("company")
            -> onUpdate("cascade")
            -> onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datasets');
    }
};
