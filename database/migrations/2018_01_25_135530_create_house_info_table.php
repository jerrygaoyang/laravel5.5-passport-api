<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('house_acreage');                           //房屋面积
            $table->string('house_decoration');                         //房屋配置
            $table->string('house_address');                            //房屋地址
            $table->string('house_date_start');                         //房屋空置期：开始时间
            $table->string('house_date_end');                           //房屋空置期：结束时间
            $table->integer('rent_price');                              //租赁价格
            $table->boolean('is_rent')->default(false);                 //是否已被租赁
            $table->integer('area_id')->default(0);                     //所属小区
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
        Schema::dropIfExists('house_info');
    }
}
