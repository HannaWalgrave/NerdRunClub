<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserScheduleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_schedule_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->date('week');
            $table->integer('week_count');
            $table->float('km_this_week');
            $table->float('km_this_week_modified');
            $table->boolean('modified_marker')->default(false);
            $table->string('message')->default("Let\'s run! Reach each week\'s goal or you will become a zombie!");
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
        Schema::dropIfExists('user_schedule_details');
    }
}
