<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraineeJourneysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainee_journeys', function (Blueprint $table) {
            $table->id();
            $table->integer('session_pin')->nullable();
            $table->string('trainee_id');
            $table->string('session_type', 3);
            $table->integer('session_number');
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
        Schema::dropIfExists('trainee_journeys');
    }
}
