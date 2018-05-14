<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentPsychologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_psychologies', function (Blueprint $table) {
            $table->increments('id');
            $table->text('quote');
            $table->string('image');
            $table->enum('status', ['0', '1'])->default('1')->comment('1: active, 0: deleted');
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
        Schema::dropIfExists('parent_psychologies');
    }
}
