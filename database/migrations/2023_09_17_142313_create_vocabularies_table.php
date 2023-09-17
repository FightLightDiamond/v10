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
        Schema::create('vocabularies', function (Blueprint $table) {
            $table->id();
            $table->string('base_word')->comment('Từ tiếng Anh gốc');
            $table->string('pronunciation')->comment('Phiên âm tiếng Anh');
            $table->string('definition')->comment('Dịch nghĩa');
            $table->string('part_of_speech')->comment('Loại từ xác định cách từ đó được sử dụng trong câu. Ví dụ: "computer" là danh từ (noun)');
            $table->tinyText('context_of_use')->nullable()->comment('hoàn cảnh sử dụng');
            $table->string('synonym')->nullable()->comment('Từ đồng nghĩa');
            $table->string('antonym')->nullable()->comment('Từ trái nghĩa');
            $table->string('img')->nullable()->comment('Từ trái nghĩa');
            $table->foreignId('programming_language_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vocabularies');
    }
};
