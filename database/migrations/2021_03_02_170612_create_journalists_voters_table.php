<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalistsVotersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journalists_voters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('journalists_id');
            $table->foreign('journalists_id')->references('id')->on('journalists');
            $table->unsignedBigInteger('voters_id');
            $table->foreign('voters_id')->references('id')->on('voters');
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
        Schema::dropIfExists('journalists_voters');
    }
}
