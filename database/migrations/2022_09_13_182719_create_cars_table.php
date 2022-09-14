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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('car_id')->unique();
            $table->string('mark');
            $table->string('model');
            $table->string('generation')->nullable();
            $table->mediumInteger('year');
            $table->mediumInteger('run');
            $table->string('color')->nullable();
            $table->string('body_type');
            $table->string('engine_type');
            $table->string('transmission');
            $table->string('gear_type');
            $table->bigInteger('generation_id')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
};
