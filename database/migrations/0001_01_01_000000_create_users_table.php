<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        
        // Cột email giữ nguyên
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        
        // 1. Sửa password thành nullable
        $table->string('password')->nullable();

        // 2. Thêm bộ 3 đồ chơi cho Google/Facebook
        $table->string('provider_id')->nullable();
        $table->string('provider')->nullable();
        $table->string('avatar')->nullable();
        
        // 3. Thêm cột phân quyền (0: User, 1: Admin)
        $table->tinyInteger('role')->default(0);

        $table->rememberToken();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
