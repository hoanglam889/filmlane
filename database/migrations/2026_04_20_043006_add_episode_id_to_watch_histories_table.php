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
        Schema::table('watch_histories', function (Blueprint $table) {
            // Kiểm tra nếu chưa có cột thì mới thêm, tránh lỗi trùng
            if (!Schema::hasColumn('watch_histories', 'episode_id')) {
                $table->foreignId('episode_id')
                    ->after('movie_id') // Nhét nó đứng sau movie_id cho đẹp
                    ->nullable()
                    ->constrained('episodes') // Ép nó theo bảng episodes xịn
                    ->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('watch_histories', function (Blueprint $table) {
            $table->dropForeign(['episode_id']);
            $table->dropColumn('episode_id');
        });
    }
};
