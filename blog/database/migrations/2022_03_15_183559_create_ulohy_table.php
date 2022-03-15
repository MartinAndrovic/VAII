<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUlohyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ulohy', function (Blueprint $table) {
            $table->id();
            $table->string('nazov');
            $table->bigInteger('zadania_id')->default(0);
            $table->string('obrazok')->default(0);
            $table->string('token')->default(0);
            $table->text('riadiace')->default('nic');
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
        Schema::dropIfExists('ulohy');
    }
}
