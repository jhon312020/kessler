<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraineesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainees', function (Blueprint $table) {
            $table->id();
            $table->integer('session_pin')->nullable();
            $table->text('recall_words')->nullable();
            $table->text('ans_contextual_cue')->nullable();
            $table->text('ans_categorical_cue')->nullable();
            $table->text('dk_contextual_cue')->nullable();
            $table->text('dk_categorical_cue')->nullable();
            $table->text('correct_ans_contextual_cue')->nullable();
            $table->text('correct_ans_categorical_cue')->nullable();
            $table->text('incorrect_ans_contextual_cue')->nullable();
            $table->text('incorrect_ans_categorical_cue')->nullable();
            $table->integer('num_correct_ans_contextual_cue')->nullable();
            $table->integer('num_correct_ans_categorical_cue')->nullable();
            $table->integer('num_incorrect_ans_contextual_cue')->nullable();
            $table->integer('num_incorrect_ans_categorical_cue')->nullable();
            $table->integer('num_dk_contextual_cue')->nullable();
            $table->integer('num_dk_categorical_cue')->nullable();
            $table->integer('total')->default(20);
            $table->longtext('story')->nullable();
            $table->integer('round')->default(1);
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
        Schema::dropIfExists('trainees');
    }
}
