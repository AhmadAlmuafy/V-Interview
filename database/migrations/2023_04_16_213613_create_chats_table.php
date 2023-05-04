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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("company_id");
            $table->foreign("company_id")
            -> references("id")
            -> on("company")
            -> onUpdate("cascade")
            -> onDelete("cascade");
            $table->unsignedBigInteger("developer_id");
            $table->foreign("developer_id")
            -> references("id")
            -> on("developer")
            -> onUpdate("cascade")
            -> onDelete("cascade");
            $table->timestamp("last_message");
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
        Schema::dropIfExists('chats');
    }
};
