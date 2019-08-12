<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeServerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_server', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attribute_id');
            $table->integer('server_id');
            $table->integer('warning_threshold');
            $table->integer('critical_threshold');
            $table->string('disk_name')->nullable();
            $table->string('disk_location')->nullable();
            $table->string('email');
            $table->boolean('visibility')->default(0);
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
        Schema::dropIfExists('attribute_server');
    }
}
