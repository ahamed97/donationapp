<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->integer('donation_type_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('add_line_1')->nullable();
            $table->string('add_line_2')->nullable();
            $table->string('add_line_3')->nullable();
            $table->float('latitude', 10, 6)->nullable()->index();
			$table->float('longitude', 10, 6)->nullable()->index();
            $table->integer('district_id')->nullable();
            $table->integer('state')->nullable();
            $table->string('nic')->nullable();
            $table->string('image_url_1')->nullable();
            $table->string('image_url_2')->nullable();
            $table->integer('donater_id')->nullable();
            $table->integer('driver_id')->nullable();
            $table->integer('weight_id')->nullable();
            $table->integer('vehicle_type_id')->nullable();
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
        Schema::dropIfExists('donations');
    }
}
