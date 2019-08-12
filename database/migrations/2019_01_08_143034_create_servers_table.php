<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->string('hostname')->nullable();
            $table->string('ipaddress')->nullable();
            $table->string('notification_email')->nullable();
            $table->longText('remarks')->nullable();
            $table->dateTime('server_time')->nullable();
            $table->timestamps();

            Schema::table('services', function (Blueprint $table){
                $table->integer('server_id')->unsigned()->nullable();
                $table->foreign('server_id')->references('id')->on('servers')->onDelete('cascade')->onUpdate('cascade');
            });

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servers');
    }
}
