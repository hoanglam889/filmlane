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
        Schema::table('users', function (Blueprint $table) {
            // 1. Ép cái cột password cũ thành cho phép rỗng (nullable)
            $table->string('password')->nullable()->change();
            
            // 2. Đắp thêm bộ 3 đồ chơi cho Google/Facebook
            $table->string('provider_id')->nullable();
            $table->string('provider')->nullable();
            $table->string('avatar')->nullable();
            
            // 3. Thêm cột phân quyền (0: Dân thường, 1: Admin)
            $table->tinyInteger('role')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Rollback lại nếu sếp muốn đổi ý
            $table->string('password')->nullable(false)->change();
            $table->dropColumn(['provider_id', 'provider', 'avatar', 'role']);
        });
    }
};
