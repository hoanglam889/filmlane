<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('movies', function (Blueprint $table) {
            // THÊM DÒNG NÀY: Tạo cột status, mặc định khi thêm phim mới là 'active' (Đang hiện)
            // Ông có thể dùng string() hoặc boolean() tùy ý, ở đây tui xài string cho dễ hiểu
            $table->string('status', 50)->default('active')->after('resolution'); 
            // (after 'resolution' là tui ví dụ nhét nó đứng sau cột chất lượng, ông đổi tên cột cho đúng DB của ông nha, hoặc xóa hàm after đi cũng chả sao)
        });
    }

    public function down()
    {
        Schema::table('movies', function (Blueprint $table) {
            // THÊM DÒNG NÀY: Để lỡ ông muốn rollback (hủy) thì nó tự drop cái cột này đi
            $table->dropColumn('status');
        });
    }
};