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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')   ->constrained('users')->onDelete('cascade');
            $table->date('startDate')      ->comment('開始日');
            $table->date('endDate')        ->comment('終了日');
            $table->string('eventName')    ->comment('イベント名');
            $table->text('detail')         ->comment('詳細');
            $table->string('scheduleColor')->comment('予定色');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
