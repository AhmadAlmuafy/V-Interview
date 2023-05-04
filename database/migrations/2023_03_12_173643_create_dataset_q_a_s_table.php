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
        Schema::create('dataset_q_a_s', function (Blueprint $table) {
            $table->id();
            $table->text("question");
            $table->text("answer");
            $table->unsignedInteger("data_set_id");
            $table->foreign("data_set_id")
            -> references("id")
            -> on("datasets")
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
        Schema::dropIfExists('dataset_q_a_s');
    }
};
