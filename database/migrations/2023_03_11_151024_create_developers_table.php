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
    public function up() {
        Schema::create('developer', function (Blueprint $table) {
            $table->id();
            $table->string("email", 150);
            $table->string("password", 255);
            $table->string("full_name", 100);
            $table->string("phone", 15);
            $table->string("photo", 255);
            $table->text("location");
            $table->text("skills");
            $table->date("birth_date");
            $table->tinyInteger("active");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('developer');
    }
};
