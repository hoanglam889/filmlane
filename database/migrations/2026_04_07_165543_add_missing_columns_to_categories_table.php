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
    Schema::table('categories', function (Blueprint $table) {
        // Thêm cột deleted_at để Laravel chạy được chức năng Ẩn/Hiện danh mục
        $table->softDeletes(); 
        
        // File SQL cũ của sếp thiếu luôn 2 cột thời gian nên tui bồi thêm cho đủ bộ
        // (Không có 2 cột này lúc sếp bấm Thêm/Sửa nó lại báo lỗi tiếp)
        $table->timestamps(); 
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            //
        });
    }
};
