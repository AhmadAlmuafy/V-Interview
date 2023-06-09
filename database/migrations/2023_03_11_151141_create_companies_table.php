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
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string("email", 150);
            $table->string("password", 255);
            $table->string("full_name", 100);
            $table->text("location");
            $table->string("phone", 15);
            $table->text("industry") -> nullable();
            $table->string("website", 255) -> nullable();
            $table->date("founded") -> nullable();
            $table->string("photo", 255) -> nullable();
            $table->text("description") -> nullable();
            $table->tinyInteger("active") -> nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company');
    }
};
