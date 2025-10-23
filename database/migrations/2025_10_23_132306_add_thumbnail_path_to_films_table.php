// database/migrations/YYYY_MM_DD_HHMMSS_add_thumbnail_path_to_films_table.php

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
        Schema::table('films', function (Blueprint $table) {
            // Tambahkan kolom thumbnail_path, bisa null sementara
            $table->string('thumbnail_path')->nullable()->after('trailer_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('films', function (Blueprint $table) {
            // Hapus kolom jika migration di-rollback
            $table->dropColumn('thumbnail_path');
        });
    }
};