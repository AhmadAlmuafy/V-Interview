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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->text("job_details");
            $table->text("skills");
            $table->unsignedTinyInteger("job_title_id") -> nullable();
            $table->foreign("job_title_id")
            -> references("id")
            -> on("job_titles")
            -> onUpdate("cascade")
            -> onDelete("set null");
            $table->unsignedTinyInteger("salary_id") -> nullable();
            $table->foreign("salary_id")
            -> references("id")
            -> on("salaries")
            -> onUpdate("cascade")
            -> onDelete("set null");
            $table->unsignedTinyInteger("location_id") -> nullable();
            $table->foreign("location_id")
            -> references("id")
            -> on("locations")
            -> onUpdate("cascade")
            -> onDelete("set null");
            $table->unsignedTinyInteger("employment_type_id") -> nullable();
            $table->foreign("employment_type_id")
            -> references("id")
            -> on("employment_types")
            -> onUpdate("cascade")
            -> onDelete("set null");
            $table->unsignedInteger("data_set_id") -> nullable();
            $table->foreign("data_set_id")
            -> references("id")
            -> on("datasets")
            -> onUpdate("cascade")
            -> onDelete("set null");
            $table->unsignedBigInteger("company_id");
            $table->foreign("company_id")
            -> references("id")
            -> on("company")
            -> onUpdate("cascade")
            -> onDelete("cascade");
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
        Schema::dropIfExists('advertisements');
    }
};
