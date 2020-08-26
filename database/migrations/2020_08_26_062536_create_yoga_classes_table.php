<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYogaClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yoga_classes', function (Blueprint $table) {
            $table->id();
            $table->char('instructor', 100);
            $table->integer('attendent');
            $table->char('vitamin_D')->nullable();
            $table->date('started_at')->nullable();
            $table->date('ended_at')->nullable();
            $table->mediumText('notes')->nullable();
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
        Schema::dropIfExists('yoga_classes');
    }
}
