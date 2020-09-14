<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthIndexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_indexes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained("members")->onDelete("cascade");
            $table->decimal('weight', 4, 1)->nullable();
            $table->decimal('body_fat', 4, 1)->nullable();
            $table->decimal('belly_fat', 4, 1)->nullable();
            $table->decimal('subcutaneous_fate', 4, 1)->nullable();
            $table->decimal('colon_fat', 4, 1)->nullable();
            $table->decimal('bone_muscle_mass', 4, 1)->nullable();
            $table->bigInteger('vitamin_D')->nullable();
            $table->date('date')->nullable();
            $table->integer('time')->nullable();
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
        Schema::dropIfExists('health_indexes');
    }
}
