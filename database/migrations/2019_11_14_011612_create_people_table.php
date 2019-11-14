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
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('university_id_number');
            $table->string('first_name', 255)->comment('A university member\'s first name');
            $table->string('preferred_first_name', 255)->nullable()->comment('A university member\'s first name');
            $table->string('last_name', 255)->comment('A university member\'s last name');
            $table->string('user_type', 255)->comment('Denotes whether student, staff, faculty, etc.');
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
        Schema::dropIfExists('people');
    }
}
