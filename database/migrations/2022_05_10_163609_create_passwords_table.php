<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Password;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('passwords', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamp('last_used')->nullable();
            $table->string('url');
            $table->string('name', 50)->nullable();
            $table->string('username', 100);
            $table->string('password', 150);
            $table->text('note')->nullable();
            $table->tinyInteger('is_favourite')->default(Password::NOT_FAVOURITE);
            $table->tinyInteger('report')->default(Password::NOT_CHECKED);
            $table->string('logo')->default('logo.png');
            $table->softDeletes();

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
        Schema::dropIfExists('passwords');
    }
};
