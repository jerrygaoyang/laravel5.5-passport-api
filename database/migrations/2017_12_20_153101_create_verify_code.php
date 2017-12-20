<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerifyCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verify_code', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account', 30);        //账号（手机/邮箱）
            $table->string('category', 10);       //账号类型（phone/email）
            $table->string('code', 10);           //验证码
            $table->integer('revoked')->default(0);      //是否失效（用于一次性校验使用）
            $table->dateTime('expires_at');              //有效期
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
        Schema::dropIfExists('verify_code');
    }
}
