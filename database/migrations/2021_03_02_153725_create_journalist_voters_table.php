<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalistVotersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journalist_voters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('journalist_id');
            $table->foreign('journalist_id')->references('id')->on('journalists');
            $table->unsignedBigInteger('voter_id');
            $table->foreign('voter_id')->references('id')->on('voters');
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
        Schema::dropIfExists('journalist_voters');
    }
}
