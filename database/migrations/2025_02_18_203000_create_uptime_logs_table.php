<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\UptimeMonitor\Models\Enums\UptimeStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('uptime_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('monitor_id')->constrained()->onDelete('cascade')->default(1);
            $table->string('url')->default('');
            $table->string('label')->default('');
            $table->string('status')->default(UptimeStatus::NOT_YET_CHECKED);
            $table->text('failure_reason')->nullable();
            $table->integer('response_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uptime_logs');
    }
};
