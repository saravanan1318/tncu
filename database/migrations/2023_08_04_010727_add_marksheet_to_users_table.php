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
        Schema::table('student_params', function (Blueprint $table) {
            //
            $table->string('slmarksheetfile');
            $table->string('hsmarksheetfile');
            $table->string('ugmarksheetfile');
            $table->string('bgmarksheetfile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_params', function (Blueprint $table) {
            //
        });
    }
};
