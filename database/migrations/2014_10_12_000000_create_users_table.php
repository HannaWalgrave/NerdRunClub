<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('strava_id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('sex')->nullable();
            $table->string('profile');  // avatar with 124x124 pixel dimension
            $table->string('token');
            $table->integer('schedule_id');
            $table->date('init_date');
            $table->date('start_date');
            $table->integer('number_weeks');
            $table->float('km_per_week');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
