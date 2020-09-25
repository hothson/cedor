<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYogaAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yoga_attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId("member_id")->constrained("members")->onDelete("cascade");
            $table->foreignId("yoga_id")->constrained("walking_classes")->onDelete("cascade");
            $table->date('attendance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yoga_attendance');
    }
}
