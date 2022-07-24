<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip', function (Blueprint $table) {
            $table->id();
            $table->integer('trip_owner_user_id');
            $table->integer('trip_owner_company_id');
            $table->string('from_address');
            $table->integer('from_state_id');
            $table->integer('from_city_id');
            $table->string('from_postcode');
            $table->string('to_address');
            $table->integer('to_state_id');
            $table->integer('to_city_id');
            $table->string('to_postcode');
            $table->string('description_trip');
            $table->integer('no_of_passengers');
            $table->integer('trip_confirm_user_id');
            $table->integer('trip_confirm_company_id');
            $table->integer('trip_status');
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
        Schema::dropIfExists('trip');
    }
}
