<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audits', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('event');

            $table->string('entity');

            $table->unsignedBigInteger('entity_id');

            $table->unsignedBigInteger('user_id')->nullable();

            $table->longText('old_values')->nullable();

            $table->longText('new_values')->nullable();

            $table->string('ip')->nullable();

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
        Schema::dropIfExists('audits');
    }
}
