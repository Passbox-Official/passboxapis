<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 40)->nullable();
            $table->string('middle_name', 40)->nullable();
            $table->string('last_name', 40)->nullable();

            $table->string('email')->unique();
            $table->string('password');

            $table->string('avatar', 50)->nullable();
            $table->tinyInteger('status')->default(User::ACTIVE);
            $table->string('gender', 15)->default(User::UNSPECIFIED);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
