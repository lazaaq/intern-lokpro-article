<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelamarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelamars', function (Blueprint $table) {
            $table->id();
            $table->string('pelamar_id');
            $table->string('lamaran_id');
            $table->string('ktp_number');
            $table->string('place_of_birth');
            $table->string('date_of_birth');
            $table->string('address');
            $table->string('phone_number');
            $table->string('gender');
            $table->string('religion');
            $table->string('marital_status');
            $table->string('document');
            $table->string('status');
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
        Schema::dropIfExists('pelamars');
    }
}
