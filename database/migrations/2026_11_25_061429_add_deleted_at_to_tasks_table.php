<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('priority')->default('Medium');
            $table->datetime('due_date_time')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn([
                'priority',
                'due_date',
                'completed_at',
            ]);

            $table->dropSoftDeletes();
        });
    }
};
