<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('height')->nullable();
            $table->decimal('mass')->nullable();
            $table->string('hair_color')->nullable();
            $table->string('skin_color');
            $table->string('birth_year')->nullable();
            $table->string('gender')->nullable();
            $table->string('homeworld_name')->nullable();
            $table->string('species_name')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('characters');
    }
}
