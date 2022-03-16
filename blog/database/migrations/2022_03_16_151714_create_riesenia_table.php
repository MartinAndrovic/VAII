<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRieseniaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riesenia', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('studenti_id')->default(0);
            $table->bigInteger('ulohy_id')->default(0);
            $table->string('konfiguracia')->default(0);
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
        Schema::dropIfExists('riesenia');
    }
}
