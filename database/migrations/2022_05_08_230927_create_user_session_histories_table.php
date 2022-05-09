<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_session_history', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('email');

            $table->dateTime('login_at');
            $table->dateTime('logout_at')->nullable();

            $table->string('token_name');
            $table->string('token');
            $table->string('roles', 20);
            $table->string('permissions');

            $table->string('device_name')->nullable()->comment('User defined device name');
            $table->string('platform')->nullable()->comment('OS name');
            $table->string('device_info')->nullable()->comment('This data will be gathered from navigator.userAgent');
            $table->string('device_id')->nullable()->comment('This id will be gathered from a cookie or localStorage');

            $table->softDeletes();
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
        Schema::dropIfExists('user_session_history');
    }
};
