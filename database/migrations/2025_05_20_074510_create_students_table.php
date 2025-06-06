<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('vardas');
            $table->string('pavarde');
            $table->date('gim_data');
            $table->string('telefonas');
            $table->text('adresas');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
