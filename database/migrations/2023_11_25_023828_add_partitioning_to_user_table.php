<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Thêm cột hash để sử dụng trong phân vùng
            Schema::table('users', function (Blueprint $table) {
                $table->string('hash', 32)->nullable()->after('id');
            });

            // Cập nhật dữ liệu cho cột hash
            DB::statement('UPDATE users SET hash = MD5(id)');

            // Tạo phân vùng cho bảng
            DB::statement('ALTER TABLE users
            PARTITION BY HASH (hash)
            PARTITIONS 10'); // Số lượng phân vùng, thay đổi theo nhu cầu của bạn
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Xóa cột hash
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('hash');
            });

            // Xóa phân vùng
            DB::statement('ALTER TABLE users REMOVE PARTITIONING');
        });
    }
};
