<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('server_id');
            $table->string('systemuptime')->nullable();
            $table->bigInteger('memtotal')->nullable();
            $table->bigInteger('memfree')->nullable();
            $table->float('loadaverage', 8, 2)->nullable();
            $table->string('disktotal')->nullable();
            $table->string('diskused')->nullable();
            $table->longText('additional_attributes')->nullable();
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
        Schema::dropIfExists('values');
    }


}
