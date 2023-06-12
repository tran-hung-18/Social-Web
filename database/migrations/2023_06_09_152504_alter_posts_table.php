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
        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained("users");
            $table->foreignId('category_id')->constrained("categories");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('posts', function (Blueprint $table) {
        //     $table->dropForeign('posts_users_id_foreign	');
        //     $table->dropForeign('posts_posts_id_foreign	');

        //     $table->dropColumn('users_id');
        //     $table->dropColumn('posts_id');
        // });
    }
};
