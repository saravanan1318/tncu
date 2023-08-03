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
        Schema::create('student_params', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->unique();  
            $table->string('fullname'); 
            $table->string('gender');                
            $table->date('dob');
            $table->string('age');
            $table->string('mobile1');
            $table->string('mobile2');
            $table->string('aadhar');
            $table->string('email');
            $table->string('parent');
            $table->string('religion');
            $table->string('otherreligion');
            $table->string('plotno');
            $table->string('streetname');
            $table->string('city');
            $table->string('district');
            $table->string('state');
            $table->string('pincode');
            $table->string('pplotno');
            $table->string('pstreetname'); 
            $table->string('pcity');
            $table->string('pdistrict');
            $table->string('pstate');
            $table->string('ppincode');
            $table->string('community');
            $table->string('subcaste');
            $table->string('Communityfile');
            $table->string('isdifferentlyabled');
            $table->string('typeofd');
            $table->string('iswidow');
            $table->string('isserviceman');
            $table->string('tccertificatefile');
            $table->string('slmedium');
            $table->string('slnameinst');
            $table->string('slYOP');
            $table->string('asltotalmark');
            $table->string('aslsecumark');
            $table->string('aslpercentage');
            $table->string('slgrade');
            $table->string('hsmedium');
            $table->string('hsnameinst');
            $table->string('hsYOP');
            $table->string('ahstotalmark');
            $table->string('ahssecumark');
            $table->string('ahspercentage');
            $table->string('hsgrade');
            $table->string('ugmedium');
            $table->string('ugnameinst');
            $table->string('ugYOP');
            $table->string('ugtotalmark');
            $table->string('ugsecumark');
            $table->string('ugpercentage');
            $table->string('uggrade');
            $table->string('bgmedium');
            $table->string('bgnameinst');
            $table->string('bgYOP');
            $table->string('bgtotalmark');
            $table->string('bgsecumark');
            $table->string('bgpercentage');
            $table->string('bggrade');
            $table->string('icm');
            $table->string('Amount');
            $table->string('UploadImg');
            $table->string('fcsign');
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
        Schema::dropIfExists('student_params');
    }
};
