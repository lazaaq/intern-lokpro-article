<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobseekerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobseeker_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jobseeker_id')->constrained('users', 'id');
            $table->foreignId('province_id')->constrained('provinces', 'id');
            $table->foreignId('city_id')->constrained('cities', 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobseeker_addresses');
    }
}
