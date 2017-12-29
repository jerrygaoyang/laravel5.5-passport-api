<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIotDeviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iot_device', function (Blueprint $table) {
            $table->increments('id');
            $table->string('device_id');
            $table->string('device_name');
            $table->string('device_secret');
            $table->string('device_mac');
            $table->string('device_qrticket')->nullable();
            $table->string('product_key');
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
        Schema::dropIfExists('iot_device');
    }
}
