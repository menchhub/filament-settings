<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('settings')) { // ✅ Check if table already exists
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->string('group');
                $table->string('name');
                $table->boolean('locked')->default(false);
                $table->json('payload');
                $table->timestamps();

                $table->unique(['group', 'name']);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('settings')) { // ✅ Prevent deleting if another package uses it
            Schema::dropIfExists('settings');
        }
    }
};
