<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('movies', function (Blueprint $table) {
        // Thêm cột 'type', chỉ nhận 2 giá trị: 'single' (Phim lẻ) và 'series' (Phim bộ)
        // Đặt nó đứng sau cột 'title' hoặc 'description' cho dễ nhìn
        $table->enum('type', ['single', 'series'])->default('single')->after('title');
    });
}

public function down()
{
    Schema::table('movies', function (Blueprint $table) {
        $table->dropColumn('type');
    });
}
};
