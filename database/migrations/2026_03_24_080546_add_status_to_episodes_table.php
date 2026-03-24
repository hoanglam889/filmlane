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
            Schema::table('episodes', function (Blueprint $table) {
                // Thêm cột status, mặc định là 'active' và nằm sau cột video_link cho gọn
                $table->string('status')->default('active')->after('video_link');
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('episodes', function (Blueprint $table) {
            //
        });
    }
};
